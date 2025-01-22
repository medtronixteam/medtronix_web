    @extends('layouts.dashboard')

    @section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="container mt-4 mr-3">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">System Settings</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('settings.update') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="yearly_leaves">Yearly Leaves</label>
                                                <input type="number" id="yearly_leaves" name="yearly_leaves" value="{{ $yearlyLeaves->value }}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="relaxion">Relaxion</label>
                                                <input type="number" id="relaxion" name="relaxion" value="{{ $relaxion ? $relaxion->value : '' }}" class="form-control">
                                            </div>
                                        </div>

                                    </div>

<<<<<<< HEAD
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="min_reporting_time">Min Reporting Time</label>
                                            <input type="time" id="min_reporting_time" name="min_reporting_time"
                                                value="{{ $officeTime ? $officeTime->min_reporting_time : '' }}"
                                                class="form-control" required>
                                                <span class="text-warning">Physical Employee Can't mark Attendance before Min
                                                Reporting time </span>
                                                @error('min_reporting_time')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="max_reporting_time">Max Reporting Time</label>
                                            <input type="time" id="max_reporting_time" name="max_reporting_time"
                                                value="{{ $officeTime ? $officeTime->max_reporting_time : '' }}"
                                                class="form-control" required>
                                            <span class="text-warning">Physical Employee Attendance will be in red If he/she
                                                mark after Max Reporting time </span>
                                                @error('max_reporting_time')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-6">
                                        <br>
                                        <button type="submit" class="btn btn-primary mt-2 float-right">Save</button>
                                    </div>
                                </div>







                            </form>
                        </div>
                    </div>
                </div>

                <div class="container mt-4 mr-3">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card rounded-0">
                                <div class="card-header">IP Range</div>

                                <div class="card-body">
                                    <h5>Your Current IP is {{ $currentIp }}</h5>
                                    <form method="POST" action="{{ route('settings.updateIpRange') }}">
                                        @csrf
                                        @method('POST')
                                        <div class="row">
                                            <div class="col-sm-6">

                                        <div class="form-group">
                                            <label for="from">Network Name</label>
                                            <input type="text" id="network_name" name="network_name"
                                                value="" class="form-control"
                                                required>
                                            @error('from')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="to">Network ip</label>
                                                    <input type="text" id="network_ip" name="network_ip"
                                                        value="" class="form-control"
                                                        required>
                                                    @error('to')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                @if (session('error'))
                                                    <div class="text-danger">{{ session('error') }}</div>
                                                @endif
                                            </div>
                                        </div>



                                        <button type="submit" class="btn btn-primary">Save  </button>
                                    </form>

                                </div>
                            </div>
                            {{-- end of card --}}
                            <div class="card rounded-0">
                                <div class="card-header h5">
                                    Registered IPs
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Network Name</th>
                                                <th>Network IP</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                     <tbody>
                                        @foreach ($ipRange as $ipData )
                                        <tr>

                                         <td>{{$ipData->network_name}}</td>
                                         <td>{{$ipData->network_ip}}</td>
                                         <td>
                                            <a href="{{route('settings.deleteIpRange', $ipData->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure ?')">Delete</a>

                                        </td>
                                     </tr>
                                        @endforeach
                                     </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- end of card --}}
                            <div class="card rounded-0">
                                <div class="card-body">

                    <form action="{{ route('settings.qrCode') }}" method="POST">
                        @csrf
                        <div class="row form-group">
                            <div class="col mb-3">
                                <label for="qr_code_string" class="form-label">QR-CODE String</label>

                                @error('qr_code_string')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-3">
                                <button class="btn btn-dark " type="submit">Generate QR</button>
                            </div>
                             <div class="col-sm-3">
                                <a href="{{route('generate.qrCode')}}" class="btn btn-dark " type="submit">Print</a>
                            </div>
                        </div>
                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container mt-4 mr-3">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-header">Location Setting</div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('settings.updateLocation') }}">
                                        @csrf
                                        @method('POST')
                                        <div class="row">
                                            <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="from">Longitude</label>
                                            <input type="text" id="longitude" name="longitude"
                                                value="" class="form-control"
                                                required>
                                            @error('from')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="to">Latitude</label>
                                                    <input type="text" id="latitude" name="latitude"
                                                        value="" class="form-control"
                                                        required>
                                                    @error('to')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                @if (session('error'))
                                                    <div class="text-danger">{{ session('error') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="to">Radius</label>
                                                    <input type="text" id="radius" name="radius"
                                                        value="" class="form-control"
                                                        required>
                                                    @error('to')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                @if (session('error'))
                                                    <div class="text-danger">{{ session('error') }}</div>
                                                @endif
                                            </div>
                                        </div>



                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </form>

                                </div>
                            </div>
                            {{-- end of card --}}
                            {{-- <div class="card">
                                <div class="card-header h5">
                                    Registered IPs
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Network Name</th>
                                                <th>Network IP</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                     <tbody>
                                        @foreach ($ipRange as $ipData )
                                        <tr>

                                         <td>{{$ipData->network_name}}</td>
                                         <td>{{$ipData->network_ip}}</td>
                                         <td>
                                            <a href="{{route('settings.deleteIpRange', $ipData->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure ?')">Delete</a>

                                        </td>
                                     </tr>
                                        @endforeach
                                     </tbody>
                                    </table>
                                </div>
                            </div> --}}
                            {{-- end of card --}}
                            {{-- <div class="card">
                                <div class="card-body">

                    <form action="{{ route('settings.qrCode') }}" method="POST">
                        @csrf
                        <div class="row form-group">
                            <div class="col mb-3">
                                <label for="qr_code_string" class="form-label">QR-CODE String</label>

                                @error('qr_code_string')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-3">
                                <button class="btn btn-dark " type="submit">Generate QR</button>
                            </div>
                             <div class="col-sm-3">
                                <a href="{{route('generate.qrCode')}}" class="btn btn-dark " type="submit">Print</a>
                            </div>
                        </div>
                    </form>
                                </div>
                            </div> --}}

                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-4 col-md-10">
                <div class="card">
                    <div class="card-header">Office Time Settings</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.updateOfficeTime') }}">
                            @csrf
                            <input type="hidden" class="id" value="{{ $officeTime->id }}">
                            <div class="row">
                                <div class="col-6">
                                    <label for="open_time">Open Time</label>
                                    <input type="time" id="open_time" name="open_time" value="{{ $officeTime ? $officeTime->open_time : '' }}" class="form-control" required>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="close_time">Close Time</label>
                                        <input type="time" id="close_time" name="close_time" value="{{ $officeTime ? $officeTime->close_time : '' }}" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="min_reporting_time">Min Reporting Time</label>
                                        <input type="time" id="min_reporting_time" name="min_reporting_time" value="{{ $officeTime ? $officeTime->min_reporting_time : '' }}" class="form-control" required>
                                        <span class="text-warning">Physical Employee Can't mark Attendance before Min
                                            Reporting time </span>
                                        @error('min_reporting_time')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="max_reporting_time">Max Reporting Time</label>
                                        <input type="time" id="max_reporting_time" name="max_reporting_time" value="{{ $officeTime ? $officeTime->max_reporting_time : '' }}" class="form-control" required>
                                        <span class="text-warning">Physical Employee Attendance will be in red If he/she
                                            mark after Max Reporting time </span>
                                        @error('max_reporting_time')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="min_reporting_time">Emoloye Can't Mark After Report Time</label>
                                        <select class="form-control" name="" id="">
                                            <option value="no">No , can mark</option>
                                            <option value="yes">Yes , can't mark</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <br>
                                    <button type="submit" class="btn btn-primary mt-2 float-right">Save</button>
                                </div>
                            </div>







                        </form>
                    </div>
                </div>
            </div>

            <div class="container mt-4 mr-3">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">IP Range</div>

                            <div class="card-body">
                                <h5>Your Current IP is {{ $currentIp }}</h5>
                                <form method="POST" action="{{ route('settings.updateIpRange') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-sm-6">

                                            <div class="form-group">
                                                <label for="from">Network Name</label>
                                                <input type="text" id="network_name" name="network_name" value="" class="form-control" required>
                                                @error('from')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="to">Network ip</label>
                                                <input type="text" id="network_ip" name="network_ip" value="" class="form-control" required>
                                                @error('to')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            @if (session('error'))
                                            <div class="text-danger">{{ session('error') }}</div>
                                            @endif
                                        </div>
                                    </div>



                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>

                            </div>
                        </div>
                        {{-- end of card --}}
                        <div class="card">
                            <div class="card-header h5">
                                Registered IPs
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Network Name</th>
                                            <th>Network IP</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ipRange as $ipData )
                                        <tr>

                                            <td>{{$ipData->network_name}}</td>
                                            <td>{{$ipData->network_ip}}</td>
                                            <td>
                                                <a href="{{route('settings.deleteIpRange', $ipData->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure ?')">Delete</a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- end of card --}}
                        <div class="card">
                            <div class="card-body">

                                <form action="{{ route('settings.qrCode') }}" method="POST">
                                    @csrf
                                    <div class="row form-group">
                                        <div class="col mb-3">
                                            <label for="qr_code_string" class="form-label">QR-CODE String</label>

                                            @error('qr_code_string')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-3">
                                            <button class="btn btn-dark " type="submit">Generate QR</button>
                                        </div>
                                        <div class="col-sm-3">
                                            <a href="{{route('generate.qrCode')}}" class="btn btn-dark " type="submit">Print</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-4 mr-3">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">Location Setting</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('settings.updateLocation') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="from">Longitude</label>
                                                <input type="text" id="longitude" name="longitude" value="" class="form-control" required>
                                                @error('from')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="to">Latitude</label>
                                                <input type="text" id="latitude" name="latitude" value="" class="form-control" required>
                                                @error('to')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            @if (session('error'))
                                            <div class="text-danger">{{ session('error') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="to">Radius</label>
                                                <input type="text" id="radius" name="radius" value="" class="form-control" required>
                                                @error('to')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            @if (session('error'))
                                            <div class="text-danger">{{ session('error') }}</div>
                                            @endif
                                        </div>
                                    </div>



                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>

                            </div>
                        </div>
                        {{-- end of card --}}
                        {{-- <div class="card">
                                <div class="card-header h5">
                                    Registered IPs
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Network Name</th>
                                                <th>Network IP</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                     <tbody>
                                        @foreach ($ipRange as $ipData )
                                        <tr>

                                         <td>{{$ipData->network_name}}</td>
                        <td>{{$ipData->network_ip}}</td>
                        <td>
                            <a href="{{route('settings.deleteIpRange', $ipData->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure ?')">Delete</a>

                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                    </div>
                </div> --}}
                {{-- end of card --}}
                {{-- <div class="card">
                                <div class="card-body">

                    <form action="{{ route('settings.qrCode') }}" method="POST">
                @csrf
                <div class="row form-group">
                    <div class="col mb-3">
                        <label for="qr_code_string" class="form-label">QR-CODE String</label>

                        @error('qr_code_string')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="row mt-2">
                    <div class="col-sm-3">
                        <button class="btn btn-dark " type="submit">Generate QR</button>
                    </div>
                    <div class="col-sm-3">
                        <a href="{{route('generate.qrCode')}}" class="btn btn-dark " type="submit">Print</a>
                    </div>
                </div>
                </form>
            </div>
        </div> --}}
        </div>
        </div>
        </div>
        </div>
    </main>
    @endsection
