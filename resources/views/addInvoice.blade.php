@extends('includePage')
@section('contentTitle', 'Create New Invoice')
@section('contentBody')
    <div class="container mt-4">
	<h2>Create New Invoice</h2>

	@if(session('success'))
		<div class="alert alert-success">{{ session('success') }}</div>
	@endif

	@if($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form action="{{ route('invoiceStore') }}" method="POST" id="invoiceForm">
		@csrf

		<div class="row">
			<div class="col-md-6">
				<div class="form-group mb-3">
					<label for="client_id">Client</label>
					<select class="form-control" id="client_id" name="client_id" required>
						<option value="">Select Client</option>
						@foreach($clients as $client)
							<option value="{{ $client->id }}">{{ $client->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group mb-3">
					<label for="issue_date">Issue Date</label>
					<input type="date" class="form-control" id="issue_date" name="issue_date" value="{{ date('Y-m-d') }}" required>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group mb-3">
					<label for="due_date">Due Date</label>
					<input type="date" class="form-control" id="due_date" name="due_date" required>
				</div>
			</div>
		</div>

		<div class="form-group mb-3">
			<label for="notes">Notes</label>
			<textarea class="form-control" id="notes" name="notes"></textarea>
		</div>

		<h4>Invoice Items</h4>
		<div id="itemsContainer">
			<div class="item-row border p-3 mb-3 rounded">
				<div class="row">
					<div class="col-md-4">
						<label>Product</label>
						<select class="form-control product-select" name="items[0][product_id]" required>
							<option value="">Select Product</option>
							@foreach($products as $product)
								<option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} - ${{ $product->price }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-2">
						<label>Quantity</label>
						<input type="number" class="form-control quantity-input" name="items[0][quantity]" min="1" value="1" required>
					</div>
					<div class="col-md-2">
						<label>Price</label>
						<input type="number" step="0.01" class="form-control price-input" readonly>
					</div>
					<div class="col-md-2">
						<label>Total</label>
						<input type="number" step="0.01" class="form-control total-input" readonly>
					</div>
					<div class="col-md-2">
						<label>&nbsp;</label>
						<button type="button" class="btn btn-danger btn-sm remove-item d-none">Remove</button>
					</div>
				</div>
			</div>
		</div>

		<button type="button" class="btn btn-secondary mb-3" id="addItemBtn">Add Another Item</button>

		<div class="form-group mb-3">
			<strong>Total: $<span id="totalAmount">0.00</span></strong>
		</div>

		<button type="submit" class="btn btn-primary">Create Invoice</button>
	</form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let itemIndex = 1;

    document.getElementById('addItemBtn').addEventListener('click', function() {
        const container = document.getElementById('itemsContainer');
        const newRow = container.querySelector('.item-row').cloneNode(true);

        // Update names and show remove button
        const selects = newRow.querySelectorAll('select');
        const inputs = newRow.querySelectorAll('input');
        const removeBtn = newRow.querySelector('.remove-item');

        selects.forEach(select => {
            select.name = select.name.replace('[0]', '[' + itemIndex + ']');
            select.value = '';
        });

        inputs.forEach(input => {
            input.name = input.name.replace('[0]', '[' + itemIndex + ']');
            if (input.classList.contains('quantity-input')) {
                input.value = '1';
            } else if (input.classList.contains('price-input')) {
                input.value = '';
            } else if (input.classList.contains('total-input')) {
                input.value = '';
            }
        });

        removeBtn.classList.remove('d-none');
        removeBtn.addEventListener('click', function() {
            newRow.remove();
            calculateTotal();
        });

        container.appendChild(newRow);
        itemIndex++;
    });

    // Calculate total when product or quantity changes
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('product-select') || e.target.classList.contains('quantity-input')) {
            calculateTotal();
        }
    });

    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('.item-row').forEach(row => {
            const select = row.querySelector('.product-select');
            const quantity = row.querySelector('.quantity-input');
            const priceInput = row.querySelector('.price-input');
            const totalInput = row.querySelector('.total-input');

            if (select.value && quantity.value) {
                const option = select.querySelector('option[value="' + select.value + '"]');
                const price = parseFloat(option.getAttribute('data-price'));
                const qty = parseInt(quantity.value);
                const itemTotal = price * qty;

                priceInput.value = price.toFixed(2);
                totalInput.value = itemTotal.toFixed(2);
                total += itemTotal;
            } else {
                priceInput.value = '';
                totalInput.value = '';
            }
        });

        document.getElementById('totalAmount').textContent = total.toFixed(2);
    }
});
</script>
@endsection