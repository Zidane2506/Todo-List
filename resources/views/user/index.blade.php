@extends('layouts.parent')

@section('title', 'Home')

@section('content')
    <div class="section dashboard">
        <div class="card info-card customers-card">
            <div class="card-body">
                <h5 class="card-title">Home</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ Auth::user()->name }}</h6>
                        <span class="text-danger small pt-1 fw-bold">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section dashboard">
        <div class="row">
            <div class="col-md-4">
                <div class="card info-card sales-card">
                    {{-- Category Card --}}
                    <div class="card-body">
                        <h5 class="card-title">Todo List</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-card-list"></i>
                            </div>
                            <div class="ps-3">
                                <h6></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card info-card sales-card">
                    {{-- Product Card --}}
                    <div class="card-body">
                        <h5 class="card-title">In Progres</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-hourglass-split"></i>
                            </div>
                            <div class="ps-3">
                                <h6></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card info-card sales-card">
                    {{-- Product Card --}}
                    <div class="card-body">
                        <h5 class="card-title">Todo Complete</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-card-checklist"></i>
                            </div>
                            <div class="ps-3">
                                <h6></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">
                    CREATE YOUR TODO LIST
                </h5>

                <form action="{{ route('todo.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <input type="text" class="form-control row-md-6" name="title" placeholder="TODO">
                        <button class="btn btn-primary mt-1" type="submit"><i class="bi bi-plus"></i> Add Todo</button>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($todo as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->title }}</td>
                                <td>
                                    <p>Status: {{ $row->status }}</p>
                                    <!-- Form untuk mengubah status -->
                                    <form action="{{ route('todo.update', $row->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <select name="status" class="form-control">
                                                <option value="Todo" {{ $row->status === 'Todo' ? 'selected' : '' }}>Todo
                                                </option>
                                                <option value="In progress"
                                                    {{ $row->status === 'In progress' ? 'selected' : '' }}>In
                                                    Progress</option>
                                                <option value="Complete"
                                                    {{ $row->status === 'Complete' ? 'selected' : '' }}>
                                                    Complete</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('todo.destroy', $row->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                        </tr> @empty <tr>
                                <td>data empity</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
