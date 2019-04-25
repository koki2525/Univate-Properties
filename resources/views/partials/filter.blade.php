<div class="row">
        <div class="col-md-12 blue-bg p-2 p-md-4">
            <h2>Filter Weeks</h2>
            <form id="mainForm" method="POST" action="/filter/{{ $resort->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <select class="form-control" name="season">
                        <option value=""><span style="color:white;">Season</span></option>
                        <option value="Peak" {{ old('season') ==  'Peak' ? 'selected' : '' }}>Peak</option>
                        <option value="Peak 1" {{ old('season') ==  'Peak 1' ? 'selected' : '' }}>Peak 1</option>
                        <option value="Peak 2" {{ old('season') ==  'Peak 2' ? 'selected' : '' }}>Peak 2</option>
                        <option value="Peak 3" {{ old('season') ==  'Peak 3' ? 'selected' : '' }}>Peak 3</option>
                        <option value="Peak 4" {{ old('season') ==  'Peak 4' ? 'selected' : '' }}>Peak 4</option>
                        <option value="Red" {{ old('season') ==  'Red' ? 'selected' : '' }}>Red</option>
                        <option value="White" {{ old('season') ==  'White' ? 'selected' : '' }}>White</option>
                        <option value="Blue" {{ old('season') ==  'Blue' ? 'selected' : '' }}>Blue</option>
                        <option value="Flexi" {{ old('season') ==  'Flexi' ? 'selected' : '' }}>Flexi</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="bedrooms">
                            <option value="">Bedrooms</option>
                            <option value="Studio" {{ old('bedrooms') ==  'Studio' ? 'selected' : '' }}>Studio</option>
                            <option value="Hotel" {{ old('bedrooms') ==  'Hotel' ? 'selected' : '' }}>Hotel</option>
                            <option value="1" {{ old('bedrooms') ==  '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('bedrooms') ==  '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('bedrooms') ==  '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('bedrooms') ==  '4' ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('bedrooms') ==  '5'? 'selected' : '' }}>5</option>
                            <option value="6" {{ old('bedrooms') ==  '6' ? 'selected' : '' }}>6</option>
                        </select>
                </div>
                <div class="form-group">
                    <input class="form-control" type="number" step="any" id="minPrice" name="minPrice" placeholder="Minimum Price" />
                </div>
                <div class="form-group">
                    <input class="form-control" type="number" step="any" id="maxPrice" name="maxPrice" placeholder="Maximum Price" />
                </div>
                <div class="form-group">
                    <label>Filter Arrival Date From</label>
                    <input style="color: white;" class="form-control" type="date" id="fromDate" name="fromDate" placeholder="Arrival Date" />
                </div>
                <div class="form-group">
                        <label>Filter Arrival Date To</label>
                    <input style="color: white;" class="form-control" type="date" id="toDate" name="toDate" placeholder="Departure Date" />
                </div>
    
                <button class="btn btn-blue" type="submit">FILTER</button>
            </form>
        </div>
    </div>