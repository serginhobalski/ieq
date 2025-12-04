@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="row g-3">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header position-relative">
                    <h5 class="mb-0 mt-1">Todos os Cursos</h5>
                    <div class="bg-holder d-none d-md-block bg-card"
                        style="background-image:url({{ asset('') }}assets/img/illustrations/corner-6.png);">
                    </div>
                    <!--/.bg-holder-->
                </div>
            </div>
            <div class="row mb-3 g-3">
                @foreach ($courses as $course)
                    <article class="col-md-6 col-xxl-4">
                        <div class="card h-100 overflow-hidden">
                            <div class="card-body p-0 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="hoverbox text-center">
                                        <a class="text-decoration-none" href="{{ asset('') }}assets/video/beach.mp4"
                                            data-gallery="attachment-bg">
                                            @if ($course->cover_image)
                                                <img src="{{ asset('storage/' . $course->cover_image) }}" class="card-img-top"
                                                    alt="..." style="height: 150px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('assets/img/elearning/courses/' . $course->category . '.png') }}"
                                                    class="card-img-top" alt="..."
                                                    style="height: 150px; object-fit: cover;">
                                            @endif
                                        </a>
                                        <div class="hoverbox-content flex-center pe-none bg-holder overlay overlay-2">
                                            <img class="z-1" src="{{ asset('') }}assets/img/icons/play.svg"
                                                width="60" alt="" />
                                        </div>
                                    </div>
                                    <div class="p-3">
                                        <h5 class="fs-9 mb-2">
                                            <a class="text-1100" href="{{ route('courses.show', $course->id) }}">
                                                {{ $course->title }}
                                            </a>
                                        </h5>
                                        <h5 class="fs-9">
                                            <a href="{{ route($course->category) }}">
                                                {{ strtoupper($course->category) }}
                                            </a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row g-0 mb-3 align-items-end">
                                    <div class="col ps-3">
                                    </div>
                                    <div class="col-auto pe-3">
                                        <a class="btn btn-sm btn-falcon-default me-2 hover-danger"
                                            href="{{ route('courses.show', $course->id) }}" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Visualizar Curso">
                                            <span class="far fa-edit" data-fa-transform="down-2"></span>
                                        </a>
                                        <a class="btn btn-sm btn-falcon-default hover-danger" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Deetar Curso"
                                            href="{{ route('courses.destroy', $course->id) }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <span class="fas fa-trash-alt" data-fa-transform="down-2"></span>
                                        </a>
                                        <form id="logout-form" action="{{ route('courses.destroy', $course->id) }}"
                                            method="POST" class="d-none">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-falcon-default hover-primary" href="#!"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Deletar Curso">
                                                <span class="fas fa-trash-alt" data-fa-transform="down-2"></span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row g-3 flex-center justify-content-md-between">
                        <div class="col-auto">
                            <form class="row gx-2">
                                <div class="col-auto"><small>Mostrar:</small></div>
                                <div class="col-auto"> <select class="form-select form-select-sm" aria-label="Show courses">
                                        <option selected="selected" value="9">9</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                    </select></div>
                            </form>
                        </div>
                        <div class="col-auto"> <button class="btn btn-falcon-default btn-sm me-2" type="button"
                                disabled="disabled" data-bs-toggle="tooltip" data-bs-placement="top" title="Prev"><span
                                    class="fas fa-chevron-left"></span></button><a
                                class="btn btn-sm btn-falcon-default text-primary me-2" href="#!">1</a><a
                                class="btn btn-sm btn-falcon-default me-2" href="#!">2</a><a
                                class="btn btn-sm btn-falcon-default me-2" href="#!"> <span
                                    class="fas fa-ellipsis-h"></span></a><a class="btn btn-sm btn-falcon-default me-2"
                                href="#!">303</a><button class="btn btn-falcon-default btn-sm" type="button"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Next"><span
                                    class="fas fa-chevron-right"></span></button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
