<div class="row">
    <div class="col-md-12 blue-bg p-2 p-md-4">
        <h2>Contact</h2>
        <form id="mainForm" method="POST" action="/contact-us/{{ $resort->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <input class="form-control" type="text" name="name" placeholder="Name" />
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email" />
            </div>
            <div class="form-group">
                <input class="form-control" type="text" id="mobile" name="cell" placeholder="Contact number" />
            </div>
            <div class="form-group">
                <textarea class="form-control" name="message" placeholder="Message"></textarea>
            </div>

            <button class="btn btn-blue" type="submit">SEND</button>
        </form>
    </div>
</div>
<div class="row mb-4">
@if($resort->facilities!=NULL)
    <div class="col-md-12 light-blue-bg p-2 p-md-4">
        <h2>Facilities</h2>
        <ul class="facilities">
        @foreach($facilities as $facility)
            <li>{{ $facility }}</li>
        @endforeach
        </ul>
    </div>
@endif
</div>