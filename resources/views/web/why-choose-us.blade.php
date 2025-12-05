@php
    $title = 'Why Choose Us';
@endphp

@push('css')
    <link rel="stylesheet" href="{{ asset('css/why-choose-us.css') }}">
@endpush

<x-web-layout :title="$title" :sidebar="true">
    <h2>Why Shinkyowa?</h2>
    <p>The most trust worthy company. Shinkyowa japan is the leading brand in export business for new and used vehicles
        for
        more than 3 decades. A well reputed entity among dealers and users across the globe.</p>
    <h3>24/7 Customer Support:</h3>
    <p>Shinkyowa Japan provides 24/7 customer support system specially designed for our prestigious clients to answer
        any
        kind of queries as soon as possible. So that our clients can have better experience.</p>
    <h3>Regularly Updated Stock:</h3>
    <p>Our customers can browse through regularly updated stock of shinkyowa international. Where hundreds of vehicles
        in a
        very good condition are waiting for them. The stock is updated every week so that clients can get their desired
        vehicle.</p>
    <h3>Guaranteed Lowest Prices:</h3>
    <p>Shinkyowa Japan continually doing its best to provide you the best at very a friendly cost. We brought mint
        condition
        vehicles for 100% customer satisfaction.</p>
    <h3>Thoroughly Inspected Vehicle:</h3>
    <p>Shinkyowa’s vehicles are thoroughly inspected by various inspection bodies and our trained certified mechanics.
        We
        ensure that once the vehicle reaches the customer it is ready to hit the road.</p>
    <h3>Well Located Shipyards:</h3>
    <p>Shinkyowa Japan’s well located shipyards are helping swift transfer of vehicles and reduce the shipment of all
        over
        japan.</p>
    <h3>Fast and Safe Delivery:</h3>
    <p>Our association with the best shipping companies make safe and timely delivery of your vehicle. Our clients can
        keep
        themselves updated about the status of their shipment by the time it reaches its destination.</p>
</x-web-layout>