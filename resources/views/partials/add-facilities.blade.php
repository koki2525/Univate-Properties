<div class="row">
        <div class="col-md-12 light-blue-bg p-2 p-md-4">
            <h2>Add resort facilities</h2>
            <form id="mainForm" method="POST" action="/add-facility" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <input class="form-control" type="hidden" name="facilities[]" placeholder="facilities" />
                    <input class="form-control" type="text" name="name" />
                </div>
    
                <button class="btn btn-blue" type="submit">ADD</button>
            </form>
        </div>
    </div>
    <div class="row mb-4">

        <div class="col-md-12 blue-bg p-2 p-md-4">
            <h2>Facilities</h2>
            <ul class="facilities">
                @foreach()
                
            </ul>
        </div>

    </div>