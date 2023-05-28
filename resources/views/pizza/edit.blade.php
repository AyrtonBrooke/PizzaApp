@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Pizza</div>

                    <form action="{{route('pizza.update',$pizza->id)}}" method="post" enctype="multipart/form-data">@csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name of Pizza</label>
                                    <input type="text" class="form-control" name="name" placeholder="name of pizza" value="{{$pizza->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description of Pizza</label>
                                    <textarea class="form-control" name="description">{{$pizza->description}}</textarea>
                                </div>
                                <div class="form-inline">
                                    <label>Pizza Prices(£)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Small</span>
                                        </div>
                                        <input type="number" name="small_pizza_price" class="form-control" placeholder="small pizza price">
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Medium</span>
                                        </div>
                                        <input type="number" name="medium_pizza_price" class="form-control" placeholder="medium pizza price">
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Large</span>
                                        </div>
                                        <input type="number" name="large_pizza_price" class="form-control" placeholder="large pizza price">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Category</label>
                                    <select class="form-control" name="category">
                                        <option value="traditional" selected>Traditional Pizza</option>
                                        <option value="vegetarian">Vegetarian Pizza</option>
                                        <option value="vegan">Vegan Pizza</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image">
                                    <img src="{{Storage::url($pizza->image) }}" width="80">
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
