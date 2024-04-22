    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Título de tu página</title>
        <!-- Agrega enlaces a tus estilos CSS y a Bootstrap si los estás utilizando -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
            crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>

    <body>

        <div class="container">
            <div class="box mt-2">
                <h2>Formulario de Venta</h2>

                <!-- contenido de la primera tabla "ventas" -->
                <form id="salesForm" method="POST" action="{{ route('sales.store') }}">
                    @csrf
                    <div class="box-body mt-5 ">

                        <div class="form-group">
                            <label for="people_id">Nombre Cliente</label>
                            <select name="people_id" id="people_id" class="form-control{{ $errors->has('people_id') ? ' is-invalid' : '' }}">
                                @foreach ($people as $personId => $personName)
                                    <option value="{{ $personId }}" data-id-card="{{ $idCards[$personId] }}">
                                        {{ $personName }}
                                    </option>
                                @endforeach
                            </select>
                            
                            @if ($errors->has('people_id'))
                                <div class="invalid-feedback">{{ $errors->first('people_id') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="id_card">Id Cliente</label>
                            <input type="text" name="id_card" id="id_card" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="date">Fecha Venta</label>
                            <input type="date" name="date"
                                class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                placeholder="Fecha Venta" min="{{ now()->format('Y-m-d') }}">
                            @if ($errors->has('date'))
                                <div class="invalid-feedback">{{ $errors->first('date') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="quotes_id">Id Cotización</label>
                            <input type="text" name="quotes_id"
                                class="form-control{{ $errors->has('quotes_id') ? ' is-invalid' : '' }}"
                                placeholder="Id Cotización">
                            @if ($errors->has('quotes_id'))
                                <div class="invalid-feedback">{{ $errors->first('quotes_id') }}</div>
                            @endif
                        </div>


                        <div class="box-footer mt-3">
                            <button type="button" class="btn btn-success btn-enviar" onclick="enviarDetalles()">
                                {{ __('Enviar') }}
                            </button>
                            <a type="button" class="btn btn-primary" href="{{ route('sales.index') }}">Volver</a>
                        </div>
                </form>
            </div>

            <div class="box mt-5  ">
                <h2> Detalle de Ventas</h2>
                <!-- contenido de la segunda tabla -->

                <div class="">
                    <div class="box-body">


                        <table id="detalle-table" class="table">
                            <thead>

                            </thead>
                            <tbody>

                                <tr>
                                    <th>
                                        <div class="form-group">
                                            {{ Form::label('Producto') }}
                                            @if ($detailSale->product)
                                                {{ Form::select('product_id', [$detailSale->product->id => $detailSale->product->name], null, ['class' => 'form-control', 'id' => 'productSelect', 'placeholder' => 'Seleccione un producto']) }}
                                            @else
                                                {{-- Aquí puedes manejar el caso cuando $detailSale->product es null --}}
                                                {{ Form::select('product_id', $products, null, ['class' => 'form-control', 'id' => 'productSelect', 'placeholder' => 'No hay productos disponibles']) }}
                                            @endif
                                            {!! $errors->first('product_id', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            {{ Form::label('Cantidad') }}
                                            {{ Form::text('quantity', $detailSale->quantity, ['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
                                            {!! $errors->first('quantity', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            {{ Form::label('Precio Unidad') }}
                                            {{ Form::text('price_unit', $detailSale->product ? $detailSale->product->price : '', ['class' => 'form-control' . ($errors->has('price_unit') ? ' is-invalid' : ''), 'placeholder' => 'Precio Unidad', 'id' => 'priceUnitInput', 'readonly' => 'readonly']) }}
                                            {!! $errors->first('price_unit', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>

                                    </th>
                                    <th>
                                        <div class="form-group">
                                            {{ Form::label('Subtotal') }}
                                            {{ Form::text('subtotal', $detailSale->subtotal, ['class' => 'form-control' . ($errors->has('subtotal') ? ' is-invalid' : ''), 'placeholder' => 'Subtotal', 'id' => 'subtotalInput', 'readonly' => 'readonly']) }}
                                            {!! $errors->first('subtotal', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            {{ Form::label('Descuento') }}
                                            {{ Form::text('discount', $detailSale->discount, ['class' => 'form-control' . ($errors->has('discount') ? ' is-invalid' : ''), 'placeholder' => 'Descuento']) }}
                                            {!! $errors->first('discount', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            {{ Form::label('Total') }}
                                            {{ Form::text('total', $detailSale->total, ['class' => 'form-control' . ($errors->has('total') ? ' is-invalid' : ''), 'placeholder' => 'Total', 'id' => 'TotalInput', 'readonly' => 'readonly']) }}
                                            {!! $errors->first('total', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <!--{{ Form::label('Id Venta') }}-->
                                            {{ Form::hidden('sales_id', $saleId, [
                                                'class' => 'form-control' . ($errors->has('sales_id') ? ' is-invalid' : ''),
                                                'placeholder' => 'Id Venta',
                                                'readonly' => true,
                                                'hidden' => true,
                                            ]) }}
                                            {!! $errors->first('sales_id', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </th>
                                    <!-- boton para eliminar el detalle creado demás -->
                                    <th>

                                        <button type="button" class="btn btn-danger mt-3"
                                            onclick="eliminarDetalle(this)">
                                            <i class="fas fa-trash-alt"></i> <!-- Icono de papelera de Font Awesome -->
                                            <!-- Texto fuera del icono -->
                                        </button>

                                    </th>
                                </tr>
                            </tbody>
                        </table>

                        <div class="box-footer">
                            <button type="button" id="agregarDetalle" class="btn btn-primary mt-2"
                                data-tipo="tipo_de_detalle">Agregar detalle</button>
                        </div>

                    </div>
                </div>
            </div>

            <script>
                // Definir la función enviarDetalles fuera del evento DOMContentLoaded
                function enviarDetalles() {
                    // Verificar si el elemento 'people_id' existe antes de intentar acceder a él
                    var peopleIdSelect = document.querySelector('select[name="people_id"]');
                    if (!peopleIdSelect) {
                        console.error("Elemento 'people_id' no encontrado");
                        return;
                    }
                
                    // Verificar si el elemento 'date' existe antes de intentar acceder a él
                    var dateInput = document.querySelector('input[name="date"]');
                    if (!dateInput) {
                        console.error("Elemento 'date' no encontrado");
                        return;
                    }
                
                    // Verificar si el elemento 'quotes_id' existe antes de intentar acceder a él
                    var quotesIdInput = document.querySelector('input[name="quotes_id"]');
                    if (!quotesIdInput) {
                        console.error("Elemento 'quotes_id' no encontrado");
                        return;
                    }
                
                    // Verificar si el elemento 'name' existe antes de intentar acceder a él
                    var nameInput = document.querySelector('input[name="name"]');
                    if (!nameInput) {
                        console.error("Elemento 'name' no encontrado");
                        return;
                    }
                
                    // Verificar si el elemento 'disable' existe antes de intentar acceder a él
                    var disableInput = document.querySelector('input[name="disable"]');
                    if (!disableInput) {
                        console.error("Elemento 'disable' no encontrado");
                        return;
                    }
                
                    const formData = {
                        _token: '{{ csrf_token() }}',
                        people_id: peopleIdSelect.value,
                        date: dateInput.value,
                        quotes_id: quotesIdInput.value,
                        name: nameInput.value,
                        disable: disableInput.value,
                        detalles: []
                    };
            
                    // Agregar un alert con los datos antes de enviarlos
                    alert('Datos a enviar: ' + JSON.stringify(formData));
            
                    document.querySelectorAll('#detalle-table tbody tr').forEach(function(detalle) {
                        const product_id = detalle.querySelector('select[name^="product_id"]').value;
                        const quantity = detalle.querySelector('input[name^="quantity"]').value;
                        const price_unit = detalle.querySelector('input[name^="price_unit"]').value;
                        const subtotal = detalle.querySelector('input[name^="subtotal"]').value;
                        const discount = detalle.querySelector('input[name^="discount"]').value;
                        const total = detalle.querySelector('input[name^="total"]').value;
                        const sales_id = detalle.querySelector('input[name^="sales_id"]').value;
            
                        formData.detalles.push({
                            product_id: product_id,
                            quantity: quantity,
                            price_unit: price_unit,
                            subtotal: subtotal,
                            discount: discount,
                            total: total,
                            sales_id: sales_id
                        });
                    });
            
                    $.ajax({
                        type: "POST",
                        url: "{{ route('sales.store') }}",
                        data: formData,
                        success: function(response) {
                            console.log(response);
                            // Aquí puedes manejar la respuesta del servidor, como redirigir o mostrar un mensaje de éxito
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            // Aquí manejas el error mostrando un alert con el mensaje de error
                            alert("Ha ocurrido un error al enviar los datos: " + xhr.responseText);
                        }
                    });
                }
            
                document.addEventListener('DOMContentLoaded', function() {
                    /*------------------------------*/
            
                    // Llamar de forma automática el valor de id del cliente
                    $(document).ready(function() {
                        // Cuando cambia la selección del nombre del cliente
                        $('#name').change(function() {
                            var idCard = $(this).find('option:selected').data(
                                'id-card'); // Obtener el ID Card de la persona seleccionada
                            $('#id_card').val(idCard); // Asignar el ID Card al campo de ID Cliente
                        });
                    });
            
                    /*------------------------------*/
            
                    // llamar el valor del producto
                    document.getElementById('productSelect').addEventListener('change', function() {
                        // Obtener el valor seleccionado del producto
                        var productId = this.value;
            
                        // Realizar una petición AJAX para obtener el precio del producto
                        // Aquí deberías hacer una solicitud al servidor para obtener el precio del producto
                        // Esto depende de cómo esté estructurado tu backend y cómo estás almacenando los precios de los productos
            
                        // Por ahora, supongamos que tienes un objeto JavaScript con los precios de los productos
                        var productPrices = {!! json_encode($productPrices) !!};
            
                        // Verificar si el producto seleccionado tiene un precio asociado
                        if (productPrices[productId]) {
                            // Actualizar el valor del campo de precio_unit con el precio del producto
                            document.getElementById('priceUnitInput').value = productPrices[productId];
                        } else {
                            // Si no hay precio asociado al producto, puedes dejar el campo de precio_unit vacío o mostrar un mensaje
                            document.getElementById('priceUnitInput').value = '';
                        }
                    });
            
                    /*------------------------------*/
            
                    // Función para agregar un nuevo detalle vacío
                    function agregarDetalle() {
                        var container = document.querySelector('#detalle-table tbody');
                        var nuevoDetalle = container.children[0].cloneNode(true);
            
                        // Limpiar los campos del nuevo detalle clonado
                        nuevoDetalle.querySelectorAll('select, input').forEach(function(element) {
                            element.value = ''; // Limpiar el valor del campo
                        });
            
                        // Agregar el nuevo detalle a la tabla
                        container.appendChild(nuevoDetalle);
            
                        // Agrega event listeners al nuevo detalle
                        addEventListeners(nuevoDetalle);
            
                        // Llamar la función para actualizar el precio del producto en el nuevo detalle
                        actualizarPrecioProducto(nuevoDetalle);
                    }
            
                    // Agregar evento de clic al botón "Agregar detalle"
                    document.getElementById('agregarDetalle').addEventListener('click', agregarDetalle);
            
                    // Función para agregar event listeners a un detalle
                    function addEventListeners(detalle) {
                        const quantityField = detalle.querySelector('[name="quantity"]');
                        const priceUnitField = detalle.querySelector('[name="price_unit"]');
                        const discountField = detalle.querySelector('[name="discount"]');
                        const subtotalField = detalle.querySelector('[name="subtotal"]');
                        const totalField = detalle.querySelector('[name="total"]');
            
                        function calculateSubtotalAndTotal() {
                            const quantity = parseFloat(quantityField.value) || 0;
                            const priceUnit = parseFloat(priceUnitField.value) || 0;
                            const discount = parseFloat(discountField.value) || 0;
            
                            const subtotal = quantity * priceUnit;
                            const total = subtotal - (subtotal * (discount / 100));
            
                            subtotalField.value = subtotal.toFixed(2);
                            totalField.value = total.toFixed(2);
                        }
            
                        // Escucha los cambios en los campos relevantes
                        quantityField.addEventListener('input', calculateSubtotalAndTotal);
                        priceUnitField.addEventListener('input', calculateSubtotalAndTotal);
                        discountField.addEventListener('input', calculateSubtotalAndTotal);
                    }
            
                    // Llamar la función para actualizar el precio del producto en un detalle específico
                    function actualizarPrecioProducto(detalle) {
                        // llamar el valor del producto
                        detalle.querySelector('[name="product_id"]').addEventListener('change', function() {
                            // Obtener el valor seleccionado del producto
                            var productId = this.value;
            
                            // Realizar una petición AJAX para obtener el precio del producto
                            // Aquí deberías hacer una solicitud al servidor para obtener el precio del producto
                            // Esto depende de cómo esté estructurado tu backend y cómo estás almacenando los precios de los productos
            
                            // Por ahora, supongamos que tienes un objeto JavaScript con los precios de los productos
                            var productPrices = {!! json_encode($productPrices) !!};
            
                            // Verificar si el producto seleccionado tiene un precio asociado
                            if (productPrices && productPrices[productId]) {
                                // Actualizar el valor del campo de precio_unit con el precio del producto
                                var price = productPrices[productId];
                                var priceUnitInput = detalle.querySelector('[name="price_unit"]');
                                if (priceUnitInput) {
                                    priceUnitInput.value = price;
                                }
                            } else {
                                // Si no hay precio asociado al producto, puedes dejar el campo de precio_unit vacío o mostrar un mensaje
                                var priceUnitInput = detalle.querySelector('[name="price_unit"]');
                                if (priceUnitInput) {
                                    priceUnitInput.value = '';
                                }
                            }
                        });
                    }
            
                    // Agregar event listeners al detalle inicial
                    addEventListeners(document.querySelector('#detalle-table tbody tr'));
            
                });
            </script>
            






    </body>

    </html>
