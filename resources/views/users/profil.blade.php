@extends('layouts.app')
@section('title')
Profil - {{ config('app.name') }}
@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow h-100">
                <div class="card-header">
                    <h5 class="m-0 pt-1 font-weight-bold">Profil</h5>
                </div>
                <div class="card-body">
                    <form action=" {{ route('update-profil', Auth::user()->id) }} " method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="text-center mb-3">
                            <img id="image" src="{{ asset(Storage::url(Auth::user()->foto)) }}" alt="{{ Auth::user()->foto }}" class="img-thumbnail mb-1">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><label for="foto" class="col-form-label">Foto</label></div>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" name="foto">
                                    <label class="custom-file-label" for="foto">Ubah Foto</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><label for="nrp" class="col-form-label">NRP</label></div>
                            <div class="col-sm-10">
                                <input disabled type="text" class="form-control" id="nrp" name="nrp" value="{{ Auth::user()->nrp }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><label for="nama" class="col-form-label">Nama</label></div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ Auth::user()->nama }}">
                                @error('nama') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $('document').ready(function(){
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>
@endpush
