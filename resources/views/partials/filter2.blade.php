<div class="row">
        <div class="col-md-12 blue-bg p-2 p-md-4">
            <h2>Filter Resorts</h2>
            <p>* Select atleast 1 filter field</p>
            <form id="mainForm" method="POST" action="/filter" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label>Resort</label>
                        <select class="form-control" id="resort" name="resort">
                            <option style="color:white;" value="">Please Select</option>
                            @foreach($resorts as $resort)
                            <option value="{{ $resort->resort }}" {{ old('resort') ==  $resort->resort  ? 'selected' : '' }}>{{ $resort->resort }}</option>
                            @endforeach
                            <option value="Other">Other</option>
                        </select>
                </div>
              
                <div class="form-group">
                    <label>Minimum Price</label>
                    <input class="form-control" type="number" step="any" id="minPrice" name="minPrice" placeholder="Minimum Price" />
                </div>
                <div class="form-group">
                    <label>Maximum Price</label>
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

                <br>
    
                <button class="btn btn-blue" type="submit">SEARCH</button>
            </form>
        </div>
    </div>