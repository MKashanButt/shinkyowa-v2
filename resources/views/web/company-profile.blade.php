@php
    $title = 'Company Profile';
@endphp

@push('css')
    <link rel="stylesheet" href="{{ asset('css/company-profile.css') }}">
@endpush

<x-web-layout :title="$title" :sidebar="true">
    <h2>Company Profile</h2>
    <p>Shinkyowa Japan is a leading auto-trading company based in Tokyo, Japan. Our expertise lies in selling high
        quality,
        economical used Japanese cars to more than 120 countries. We offer our clients a wide range of models and makes,
        all
        thoroughly inspected and maintained. Over the years, we have strengthened our processes, ensuring that our
        customers
        experience a smooth purchase process, flexible payment methods and swift shipping of their vehicles. All of this
        has
        enabled us to become a trusted name in the auto-trading industry.</p>
    <p>Shinkyowa Japan is one of the few Japanese automobile exporters that delivers cars to almost every country of the
        world and has grown with time, strengthening its roots in every market it enters. The well-trained workforce of
        Shinkyowa Japan understands the needs of the customers, therefore we arrange the most suitable cars for you and
        provide extremely courteous service. This is why the company has 70% repeat customers and a family of hundreds
        of
        highly satisfied and loyal customers in every market.</p>
    <p>The 24/7 prompt customer support is one of the major reasons why customers feel comfortable in purchasing their
        desired vehicle through Shinkyowa Japan. The company ensures that the customer finds help whenever they seek it.
    </p>

    <table>
        <tbody>
            <tr>
                <th>Company Name</th>
                <td>SHINKYOWA International Co. Ltd</td>
            </tr>
            <tr>
                <th>Head Office</th>
                <td>Gunma ken Maebashi shi Komagata Machi 150-2</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>+8127 212 9973</td>
            </tr>
            <tr>
                <th>Fax Number</th>
                <td>+8127 212 9986</td>
            </tr>
            <tr>
                <th>Business Description</th>
                <td>Export and sale of automobiles</td>
            </tr>
        </tbody>
    </table>
</x-web-layout>