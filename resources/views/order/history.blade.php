@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">Order History
                        <a style="float:right;" href="{{ url('/') }}"><button class="btn btn-danger btn-sm" style="margin-left: 5px">Order More</button></a>
                    </div>
                    <div class="card-body">
                        @php
                            $lastTotal = null;
                            $lastDeliveryChoice = null;
                            $lastDayOfOrder = null;
                        @endphp

                        @foreach($checkouts as $checkout)
                            @if ($checkout->total !== $lastTotal || $checkout->delivery_choice !== $lastDeliveryChoice || $checkout->created_at->format('M d Y') !== $lastDayOfOrder)
                                @if ($lastTotal !== null)
                                    </tbody>
                        </table>
                        <br>
                        @endif
                        <h4>Total: £{{ $checkout->total }}</h4>
                        <h5>Delivery Choice: {{ $checkout->delivery_choice }}</h5>
                        <h5>Day of Order: {{ $checkout->created_at->format('M d Y') }}</h5>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Size</th>
                                <th scope="col">Pizza</th>
                                <th scope="col">Price(£)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @endif

                            <tr>
                                <td>{{ $checkout->pizza_size }}</td>
                                <td>{{ $checkout->pizza->name }}</td>
                                <td>£{{ $checkout->pizza_price }}</td>
                            </tr>

                            @php
                                $lastTotal = $checkout->total;
                                $lastDeliveryChoice = $checkout->delivery_choice;
                                $lastDayOfOrder = $checkout->created_at->format('M d Y');
                            @endphp

                            @endforeach

                            @if ($lastTotal !== null)
                            </tbody>
                        </table>
                        @else
                            <p>No orders found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
