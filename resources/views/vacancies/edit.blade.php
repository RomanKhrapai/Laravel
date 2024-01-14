@extends('layouts.admin')

@section('title')
    Form for updating vacancies
@endsection

@section('content')
    <h1 class="text-white">Form for updating vacancies</h1>
    <span class="text-white">
        ID: {{ $vacancy->id }}
    </span>
    <form class="" action="{{ route('vacancies.update', ['vacancy' => $vacancy->id]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label class="text-white" for="title">
                title
            </label>
            <input type="text" name="title" placeholder="Enter a title" id="title" class="form-control"
                value="{{ old('title', $vacancy->title) }}" class="@error('title') is-invalid @enderror">
        </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label class="text-white" for="description">
                description
            </label>
            <input type="text" name="description" placeholder="Enter a description" id="description" class="form-control"
                value="{{ old('description', $vacancy->description) }}" class="@error('description') is-invalid @enderror">
        </div>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label class="text-white" for="salary">
                salary
            </label>
            <input type="text" name="salary" placeholder="Enter a salary" id="salary" class="form-control"
                value="{{ old('salary', $vacancy->salary) }}" class="@error('salary') is-invalid @enderror">
        </div>
        @error('salary')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label class="text-white" for="max_salary">
                max salary
            </label>
            <input type="text" name="max_salary" placeholder="Enter a max_salary" id="max_salary" class="form-control"
                value="{{ old('max_salary', $vacancy->max_salary) }}" class="@error('max_salary') is-invalid @enderror">
        </div>
        @error('max_salary')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class=" form-group">
            <label class="text-white d-block">
                Company:
                <br>
                <div class="form-control bg-white d-flex justify-content-around">
                    <select class="js-example-basic-single" name="company_id">
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}"
                                {{ $company->id == old('company_id', $vacancy->company_id) ? 'selected' : '' }}>
                                {{ $company->id }} - {{ $company->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </label>
        </div>
        @error('company_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class=" form-group">
            <label class="text-white d-block">
                Profession:
                <br>
                <div class="form-control bg-white d-flex justify-content-around">
                    <select class="js-example-basic-single" name="profession_id">
                        @foreach ($professions as $profession)
                            <option value="{{ $profession->id }}" {{ $profession->id == old('profession_id', $vacancy->profession_id) ? 'selected' : '' }}>
                                {{ $profession->id }} - {{ $profession->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </label>
        </div>
        @error('profession_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class=" form-group">
            <label class="text-white d-block">
                Area:
                <br>
                <div class="form-control bg-white d-flex justify-content-around">
                    <select class="js-example-basic-single" name="area_id">
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}"
                                {{ $area->id == old('area_id', $vacancy->area_id) ? 'selected' : '' }}>
                                {{ $area->id }} - {{ $area->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </label>
        </div>
        @error('area_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class=" form-group">
            <label class="text-white d-block">
                Nature:
                <br>
                <div class="form-control bg-white d-flex justify-content-around">
                    <select class="js-example-basic-single" name="nature_id">
                        @foreach ($natures as $nature)
                            <option value="{{ $nature->id }}"
                                {{ $nature->id == old('nature_id', $vacancy->nature_id) ? 'selected' : '' }}>
                                {{ $nature->id }} - {{ $nature->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </label>
        </div>
        @error('nature_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class=" form-group">
            <label class="text-white d-block">
                Type:
                <br>
                <div class="form-control bg-white d-flex justify-content-around">
                    <select class="js-example-basic-single" name="type_id">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}"
                                {{ $type->id == old('type_id', $vacancy->type_id) ? 'selected' : '' }}>
                                {{ $type->id }} - {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </label>
        </div>
        @error('type_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror



        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
