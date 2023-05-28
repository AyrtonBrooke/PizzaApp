@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Menu</div>

                    <div class="card-body">
                        <ul class="list-group">
                            <a href="{{route('pizza.index')}}" class="list-group-item list-group-item-action">View</a>
                            <a href="{{route('pizza.create')}}" class="list-group-item list-group-item-action">Create</a>
                            <a href="{{route('user.order')}}" class="list-group-item list-group-item-action">User Order</a>
                        </ul>
                    </div>
                </div>
                @if(count($errors)>0)
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p> {{$error}} </p>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pizza</div>

                    <form action="{{route('pizza.store')}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="card-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name of Pizza</label>
                                    <input type="text" class="form-control" name="name" placeholder="name of pizza">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description of Pizza</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                                <div class="form-inline">
                                    <label>Pizza Prices(£)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Small</span>
                                        </div>
                                        <input type="float" name="small_pizza_price" class="form-control" placeholder="small pizza price">
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Medium</span>
                                        </div>
                                        <input type="float" name="medium_pizza_price" class="form-control" placeholder="medium pizza price">
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Large</span>
                                        </div>
                                        <input type="float" name="large_pizza_price" class="form-control" placeholder="large pizza price">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Category</label>
                                    <select class="form-control" name="category">
                                        <option value="Traditional" selected>Traditional Pizza</option>
                                        <option value="Vegetarian">Vegetarian Pizza</option>
                                        <option value="Vegan">Vegan Pizza</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
