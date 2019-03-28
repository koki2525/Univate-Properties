@extends('master')

@section('title', 'My Commercial Properties')

@section('description', '')

@section('keywords', '')

@section('content')
<script>
    let rt = {};

    rt.adjustCount = 0;
    rt.firstRowValues = [];
    rt.MOBILE_SCREEN_WIDTH = 480;

    function reset() {
        rt.tableContainer = document.querySelector(".table-container");
        rt.initialState = rt.tableContainer.innerHTML;
        rt.table = document.querySelector(".responsive-table > tbody");
        rt.tableTitle = document.querySelector(".table-title");
        rt.firstRow = document.querySelector(".responsive-table tr:first-of-type");
        rt.firstRowValues = [];
    }

    reset();

    function getFirstRowValues() {
        for (let cell = 0; cell < rt.firstRow.children.length; cell++) {
            rt.firstRowValues.push(rt.firstRow.children[cell].textContent);
        }
    }

    function concatFirstRowValuesWithMainValues() {
        for (let row = 1; row < rt.table.children.length; row++) {
            for (let cell = 0; cell < rt.table.children[row].children.length; cell++) {
                rt.table.children[row].children[cell].textContent =
                rt.firstRowValues[cell] +
                ": " +
                rt.table.children[row].children[cell].textContent;
            }
        }
    }

    function consolidateCells() {
        for (let row = 1; row < rt.table.children.length; row++) {
            let rowValues = [];

            for (let cell = 0; cell < rt.table.children[row].children.length; cell++) {
                // Saving row values.
                rowValues.push(rt.table.children[row].children[cell].textContent);
            }

            rt.table.children[row].children[0].innerHTML = "";

            for (let value = 0; value < rowValues.length; value++) {
                // Inserting row values into first cell.

                let newValueFragment = document.createElement("div");
                let newValueFragmentContent = document.createTextNode(rowValues[value]);
                newValueFragment.appendChild(newValueFragmentContent);

                rt.table.children[row].children[0].appendChild(newValueFragment);
            }
        }
    }

    function removeExtraCells() {
        for (let row = 1; row < rt.table.children.length; row++) {
            for (let cell = 0; cell < rt.table.children[row].children.length; cell++) {
                // rt.table.children[row].children[cell].remove();
            }
            while (rt.table.children[row].children.length > 1) {
                rt.table.children[row].lastElementChild.remove();
            }
        }
    }

    function addTitleToTable() {
        rt.table.children[0].innerHTML = "<th>" + rt.tableTitle.textContent + "</th>";
        rt.tableTitle.remove();
    }

    function adjustTable() {
        rt.table.parentElement.classList.add("mobile");
        getFirstRowValues();
        concatFirstRowValuesWithMainValues();
        consolidateCells();
        removeExtraCells();
        addTitleToTable();
    }

    function restoreTable() {
        rt.tableContainer.innerHTML = rt.initialState;
        reset(); // Rebinding newly drawn elements.
        rt.table.parentElement.classList.remove("mobile");
    }

    document.addEventListener("DOMContentLoaded", () => {
        if (window.innerWidth <= rt.MOBILE_SCREEN_WIDTH) {
            rt.adjustCount++;
            adjustTable();
        }
    });

    window.addEventListener("resize", () => {
        if (window.innerWidth < rt.MOBILE_SCREEN_WIDTH) {
            if (!rt.adjustCount) {
                rt.adjustCount++;
                adjustTable();
            }
        } else {
            restoreTable();
            rt.adjustCount = 0;
        }
    });
    
    function Conform_Delete() {
        return confirm("Are you sure want to delete this commercial property?");
    }

</script>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-10 offset-md-1">
            <!--<form id="mainForm" method="POST" action="/search-commercial-admin" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
                <div class="form-row">
                    <div class="col-md-5 offset-md-3">
                        <input class="form-control" name="search" type="text">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-blue" type="submit">
                            <i class="fas fa-search-plus"></i>
                            SEARCH
                        </button>
                    </div>
                </div>
            </form> -->
            <div class="col-md-12">
                <h1 class="my-4">My Commercial Properties</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 offset-md-1 table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Property</th>
                        <th>Unit</th>
                        <th>Size</th>
                        <th>Price ex VAT</th>
                        <th>Region</th>
                        <th>Town</th> 
                        <th>Suburb</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Published</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($commercials as $commercial)
                    <tr>
                        <td>{{ $commercial->contact_person }}</td>
                        <td>{{ $commercial->ref }}</td>
                        <td>{{ $commercial->name }}</td>
                        <td>{{ $commercial->unit }}</td>
                        <td>{{ $commercial->size }}</td>
                        <td>{{ $commercial->price }}</td>
                        <td>{{ ucfirst(trans($commercial->region)) }}</td>
                        <td>{{ $commercial->town }}</td>
                        <td>{{ $commercial->surburb }}</td>
                        <td>{{ $commercial->status2 }}</td>
                        <td>{{ $commercial->propertType }}</td>

                        @if($commercial->published==1)
                        <td class="text-center">
                            <i class="fas fa-cloud-upload-alt fa-2x text-success"></i>
                        </td>
                        @else
                        <td class="text-center">
                            <i class="fas fa-cloud-upload-alt fa-2x text-danger"></i>
                        </td>
                        @endif
                        <td class="text-center">
                                <a href="/edit-my-commercial-property/{{ $commercial->id }}">
                                    <i class="far fa-edit blue-text fa-2x"></i>
                                </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="col-md-6 offset-md-3 mb-4 d-flex justify-content-center">
            <?php echo $commercials->links(); ?>
        </div>
    </div>
</div>


@stop
