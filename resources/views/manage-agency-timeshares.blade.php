@extends('master')

@section('title', 'Manage Agency Timeshares')

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
               <h1>Manage {{ Auth::user()->agency }} timeshares</h1>
            </div>
        </div>
    <div class="row">
        <div class="col-md-10 offset-md-1 table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Owner</th>
                        <th>Agent</th>
                        <th>Resort</th>
                        <th>Week</th>
                        <th>Module</th>
                        <th>Unit</th>
                        <th>Beds</th>
                        <th>Season</th>
                        <th>Region</th>
                        <th>Amount</th>
                        <th>Verified</th>
                        <th>Publish</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($timeshares as $timeshare)
                    <tr>
                        <td>{{ $timeshare->owner }}</td>
                        <td>{{ $timeshare->agent }}</td>
                        <td>{{ $timeshare->resort }}</td>
                        <td>{{ $timeshare->week }}</td>
                        <td>{{ $timeshare->module }}</td>
                        <td>{{ $timeshare->unit }}</td>
                        <td>{{ $timeshare->bedrooms }}</td>
                        <td>{{ ucfirst(trans($timeshare->season)) }}</td>
                        <td>{{ ucfirst(trans($timeshare->region)) }}</td>
                        <td>R {{ $timeshare->price }}</td>
                        @if($timeshare->verified==1)
                        <td class="text-center">
                            <a href="/verifyTimeshare/{{ $timeshare->id }}">
                                <i class="fas fa-cloud-upload-alt fa-2x text-success"></i>
                            </a>
                        </td>
                        @else
                        <td class="text-center">
                            <a href="/verifyTimeshare/{{ $timeshare->id }}">
                                <i class="fas fa-cloud-upload-alt fa-2x text-danger"></i>
                            </a>
                        </td>
                        @endif

                        @if($timeshare->published==1)
                        <td class="text-center">
                            <a href="/publishTimeshare/{{ $timeshare->id }}">
                                <i class="fas fa-cloud-upload-alt fa-2x text-success"></i>
                            </a>
                        </td>
                        @else
                        <td class="text-center">
                            <a href="/publishTimeshare/{{ $timeshare->id }}">
                                <i class="fas fa-cloud-upload-alt fa-2x text-danger"></i>
                            </a>
                        </td>
                        @endif

                        <td>{{ $timeshare->status }}</td>

                        <td class="text-center">
                            <a href="/edit-agency-timeshare/{{ $timeshare->id }}">
                                <i class="far fa-edit blue-text fa-2x"></i>
                            </a>
                        </td>

                        <td class="text-center">
                            <a onclick="return Conform_Delete()" href="/deleteTimeshare/{{ $timeshare->id }}">
                                <i class="fas fa-times fa-2x text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-6 offset-md-3 mb-4 d-flex justify-content-center">
            <?php echo $timeshares->links(); ?>
        </div>
    </div>
</div>


@stop
