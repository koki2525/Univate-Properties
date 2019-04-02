@extends('master')

@section('title', 'Authorise pre-listed Weeks')

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
        return confirm("Are you sure want to delete this timeshare?");
    }

</script>

<div class="container-fluid">
    <div class="row mb-4 mt-5">
        <div class="col-md-10 offset-md-1">
            <h1>Pre-listed Weeks</h1>
        </div>
    </div>
    <form id="mainForm" method="POST" action="/authorise-pre-listed-weeks" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-md-10 offset-md-1 table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Agency</th>
                        <th>Resort</th>
                        <th>Week</th>
                        <th>Module</th>
                        <th>Unit</th>
                        <th>Beds</th>
                        <th>Season</th>
                        <th>Region</th>
                        <th>Amount</th>
                        <th>Submitted</th>
                        <th>Status</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($timeshares as $timeshare)
                    <tr>
                        <td>{{ $timeshare->agency }}</td>
                        <td>{{ $timeshare->resort }}</td>
                        <td>{{ $timeshare->week }}</td>
                        <td>{{ $timeshare->module }}</td>
                        <td>{{ $timeshare->unit }}</td>
                        <td>{{ $timeshare->bedrooms }}</td>
                        <td>{{ ucfirst(trans($timeshare->season)) }}</td>
                        <td>{{ ucfirst(trans($timeshare->region)) }}</td>
                        <td>R {{ number_format($timeshare->price, 2) }}</td>
                        <td>{{ $timeshare->created_at }}</td>
                        <td>{{ $timeshare->status }}</td>
                        <th><input type="checkbox" name="selected[]" value="{{ $timeshare->id }}"></th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="btn btn-blue btn-lg" id="submit" type="submit">SUBMIT</button>
        </div>

        <div class="col-md-6 offset-md-3 mb-4 d-flex justify-content-center">
            <?php echo $timeshares->links(); ?>
        </div>
    </div>
</div>

</form>


@stop
