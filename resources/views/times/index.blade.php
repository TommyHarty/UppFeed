@extends('layouts.dashboard')

@section('content')

    <div class="dashboard-header">
        <h1>
            <i class="fa fa-clock-o" aria-hidden="true"></i> Opening Times
        </h1>
    </div>

    <div class="row menus-row">
        <div class="col-xs-12 dashboard-form">
            <form class="" method="POST" action="{{ route('update.times', $times->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="col-sm-4 col-lg-6 day">
                    Monday
                    <hr>
                </div>

                <div class="col-sm-4 col-lg-3 time-field">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="from">from</span>
                            <input type="text" class="form-control" id="monday_opening" name="monday_opening"  value="{{ old('monday_opening', $times->monday_opening) }}">
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-3 time-field">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="until">until</span>
                            <input type="text" class="form-control" id="monday_closing" name="monday_closing"  value="{{ old('monday_closing', $times->monday_closing) }}">
                        </div>
                    </div>
                </div>

                <div class="tablet-space"></div>

                <div class="col-sm-4 col-lg-6 day">
                    Tuesday
                    <hr>
                </div>

                <div class="col-sm-4 col-lg-3 time-field">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="from">from</span>
                            <input type="text" class="form-control" id="tuesday_opening" name="tuesday_opening"  value="{{ old('tuesday_opening', $times->tuesday_opening) }}">
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-3 time-field">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="until">until</span>
                            <input type="text" class="form-control" id="tuesday_closing" name="tuesday_closing"  value="{{ old('tuesday_closing', $times->tuesday_closing) }}">
                        </div>
                    </div>
                </div>

                <div class="tablet-space"></div>

                <div class="col-sm-4 col-lg-6 day">
                    Wednesday
                    <hr>
                </div>

                <div class="col-sm-4 col-lg-3 time-field">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="from">from</span>
                            <input type="text" class="form-control" id="wednesday_opening" name="wednesday_opening"  value="{{ old('wednesday_opening', $times->wednesday_opening) }}">
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-3 time-field">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="until">until</span>
                            <input type="text" class="form-control" id="wednesday_closing" name="wednesday_closing"  value="{{ old('wednesday_closing', $times->wednesday_closing) }}">
                        </div>
                    </div>
                </div>

                <div class="tablet-space"></div>

                <div class="col-sm-4 col-lg-6 day">
                    Thursday
                    <hr>
                </div>

                <div class="col-sm-4 col-lg-3 time-field">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="from">from</span>
                            <input type="text" class="form-control" id="thursday_opening" name="thursday_opening"  value="{{ old('thursday_opening', $times->thursday_opening) }}">
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-3 time-field">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="until">until</span>
                            <input type="text" class="form-control" id="thursday_closing" name="thursday_closing"  value="{{ old('thursday_closing', $times->thursday_closing) }}">
                        </div>
                    </div>
                </div>

                <div class="tablet-space"></div>

                <div class="col-sm-4 col-lg-6 day">
                    Friday
                    <hr>
                </div>

                <div class="col-sm-4 col-lg-3 time-field">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="from">from</span>
                            <input type="text" class="form-control" id="friday_opening" name="friday_opening"  value="{{ old('friday_opening', $times->friday_opening) }}">
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-3 time-field">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="until">until</span>
                            <input type="text" class="form-control" id="friday_closing" name="friday_closing"  value="{{ old('friday_closing', $times->friday_closing) }}">
                        </div>
                    </div>
                </div>

                <div class="tablet-space"></div>

                <div class="col-sm-4 col-lg-6 day">
                    Saturday
                    <hr>
                </div>

                <div class="col-sm-4 col-lg-3 time-field">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="from">from</span>
                            <input type="text" class="form-control" id="saturday_opening" name="saturday_opening"  value="{{ old('saturday_opening', $times->saturday_opening) }}">
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-3 time-field">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="until">until</span>
                            <input type="text" class="form-control" id="saturday_closing" name="saturday_closing"  value="{{ old('saturday_closing', $times->saturday_closing) }}">
                        </div>
                    </div>
                </div>

                <div class="tablet-space"></div>

                <div class="col-sm-4 col-lg-6 day">
                    Sunday
                    <hr>
                </div>

                <div class="col-sm-4 col-lg-3 time-field">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="from">from</span>
                            <input type="text" class="form-control" id="sunday_opening" name="sunday_opening"  value="{{ old('sunday_opening', $times->sunday_opening) }}">
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-3 time-field">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="until">until</span>
                            <input type="text" class="form-control" id="sunday_closing" name="sunday_closing"  value="{{ old('sunday_closing', $times->sunday_closing) }}">
                        </div>
                    </div>
                </div>

                <div class="tablet-space"></div>

                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

@endsection
