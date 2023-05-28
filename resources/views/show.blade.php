@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Menu</div>

                    <div class="card-body">
                        @if(Auth::check())
                            <form action="{{route('order.store')}}" method="post">@csrf
                                <div class="form-group">
                                    <select class="form-control" name="pizza_size" onchange="updatePrice(this)">
                                        <option value="Large" name="pizza_size" selected>Large</option>
                                        <option value="Medium" name="pizza_size">Medium</option>
                                        <option value="Small" name="pizza_size">Small</option>
                                    </select>
                                    <p><input type="hidden" name="pizza_id" value="{{$pizza->id}}"></p>
                                    <input type="hidden" name="pizza_price" id="pizzaPrice">
                                    <p><textarea class="form-control" name="body"></textarea></p>
                                    <div class="btn-group" role="group" aria-label="Order buttons">
                                        <a href="{{ url('/') }}" class="btn btn-danger">Order More</a>
                                        <button type="submit" class="btn btn-primary btn-block text-center" id="addButton">Add</button>
                                        <a href="{{ route('user.order') }}" class="btn btn-success">Checkout</a>
                                    </div>
                                @if (session('message'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    @if (session('errmessage'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('errmessage') }}
                                        </div>
                                    @endif
                                </div>
                            </form>
                        @else
                            <p><a href="/login">Please login to make an order</a> </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pizza</div>

                    <div class="card-body">
                        <div class="row">
                            <img src="{{Storage::url($pizza->image)}}" class="img-thumbnail" style="width: 100%; height: 450px;">
                            <p><h3>{{$pizza->name}}</h3></p>
                            <p><h3>{{$pizza->description}}</h3></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectElement = document.querySelector('select[name="pizza_size"]');
            const addButton = document.querySelector('#addButton');

            selectElement.addEventListener('change', function(e) {
                const selectedOption = e.target.value;
                updatePrice(selectedOption);
            });

            // Trigger initial price update
            const selectedOption = selectElement.value;
            updatePrice(selectedOption);

            // ...
            // ...
            function updatePrice(selectedOption) {
                // Use conditional statements to update the price based on the selected option
                let priceValue = 0; // Initialize price value as a number
                if (selectedOption === 'Large') {
                    priceValue = {{$pizza->large_pizza_price}};
                } else if (selectedOption === 'Medium') {
                    priceValue = {{$pizza->medium_pizza_price}};
                } else if (selectedOption === 'Small') {
                    priceValue = {{$pizza->small_pizza_price}};
                }

                // Update button text with selected price
                const buttonText = 'Add £' + priceValue;
                addButton.innerText = buttonText;

                // Update hidden input value with selected price
                const pizzaPriceInput = document.getElementById('pizzaPrice');
                pizzaPriceInput.value = priceValue;
            }
// ...

// ...

        });
    </script>
    <style>
        a.list-group-item{
            font-size: 18px;
        }
        a.list-group-item:hover {
            background-color: teal;
            color: #fff;
        }
        .card-header {
            background-color: teal;
            color: #fff;
            font-size: 20px;
        }
        .input-group-append .input-group-text {
            cursor: pointer;
        }
    </style>
@endsection
