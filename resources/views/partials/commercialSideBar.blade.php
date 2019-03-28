<div class="row">
    <div class="col-md-12 light-blue-bg p-2 p-md-4">
        <h2>{{ $property->name }} Info</h2>
        <ul class="facilities">
            @if($property->location)<li>{{ $property->location }}</li>@endif
            @if($property->price)<li>{{ $property->price }}</li>@endif
            @if($property->size)<li>{{ $property->size }}</li>@endif
            @if($property->size)<li>Parking {{ $property->parking }}</li>@endif
            @if($property->ref)<li>Ref: {{ $property->ref }}</li>@endif
        </ul>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-12 blue-bg p-2 p-md-4">
        <h2>Contact</h2>
        <form id="mainForm" method="POST" action="/contact-commercial/{{ $property->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <input class="form-control" type="text" name="name" placeholder="Name" />
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email" />
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="cell" placeholder="Contact number" />
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="property" placeholder="Property" />
            </div>
            <div class="form-group">
                <textarea class="form-control" name="message" placeholder="Message"></textarea>
            </div>

            <button class="btn btn-blue" type="submit">SEND</button>
        </form>
    </div>
</div>