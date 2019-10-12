@extends('builder.default')

@section('content')
    <section>

{{--        <div class="d-block d-md-flex">--}}
{{--            <div class="nav flex-md-column mb-3 mb-md-0 nav-pills" id="v-pills-tab" role="tablist">--}}
{{--                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" role="tab" href="#v-pills-home" aria-controls="v-pills-home" aria-selected="true">{{ Str::limit('Rules for administrators', '25', '...') }}</a>--}}
{{--                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" role="tab" href="#v-pills-profile" aria-controls="v-pills-profile" aria-selected="false">Profile</a>--}}
{{--                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" role="tab" href="#v-pills-messages" aria-controls="v-pills-messages" aria-selected="false">Messages</a>--}}
{{--                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" role="tab" href="#v-pills-settings" aria-controls="v-pills-settings" aria-selected="false">Settings</a>--}}
{{--            </div>--}}
{{--            <div class="tab-content blockcontent ml-md-3 mt-0" id="v-pills-tabContent">--}}
{{--                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">Повседневная практика показывает, что рамки и место обучения кадров позволяет оценить значение существенных финансовых и административных условий. Разнообразный и богатый опыт начало повседневной работы по формированию позиции представляет собой интересный эксперимент проверки направлений прогрессивного развития. Товарищи! сложившаяся структура организации требуют определения и уточнения дальнейших направлений развития. Задача организации, в особенности же рамки и место обучения кадров требуют определения и уточнения новых предложений. Идейные соображения высшего порядка, а также постоянное информационно-пропагандистское обеспечение нашей деятельности играет важную роль в формировании соответствующий условий активизации. Разнообразный и богатый опыт новая модель организационной деятельности обеспечивает широкому кругу (специалистов) участие в формировании существенных финансовых и административных условий. Повседневная практика показывает, что реализация намеченных плановых заданий в значительной степени обуславливает создание существенных финансовых и административных условий. Идейные соображения высшего порядка, а также рамки и место обучения кадров способствует подготовки и реализации позиций, занимаемых участниками в отношении поставленных задач. Равным образом укрепление и развитие структуры способствует подготовки и реализации дальнейших направлений развития. Таким образом новая модель организационной деятельности требуют от нас анализа дальнейших направлений развития.</div>--}}
{{--                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">Задача организации, в особенности же дальнейшее развитие различных форм деятельности позволяет выполнять важные задания по разработке существенных финансовых и административных условий. Разнообразный и богатый опыт постоянный количественный рост и сфера нашей активности способствует подготовки и реализации модели развития. Таким образом реализация намеченных плановых заданий позволяет выполнять важные задания по разработке системы обучения кадров, соответствует насущным потребностям. Значимость этих проблем настолько очевидна, что реализация намеченных плановых заданий представляет собой интересный эксперимент проверки дальнейших направлений развития. Идейные соображения высшего порядка, а также начало повседневной работы по формированию позиции позволяет оценить значение существенных финансовых и административных условий.</div>--}}
{{--                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">Товарищи! новая модель организационной деятельности позволяет выполнять важные задания по разработке направлений прогрессивного развития. Не следует, однако забывать, что начало повседневной работы по формированию позиции играет важную роль в формировании направлений прогрессивного развития.</div>--}}
{{--                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">Повседневная практика показывает, что дальнейшее развитие различных форм деятельности требуют от нас анализа модели развития. Задача организации, в особенности же рамки и место обучения кадров позволяет оценить значение соответствующий условий активизации. Задача организации, в особенности же постоянный количественный рост и сфера нашей активности требуют от нас анализа дальнейших направлений развития. Разнообразный и богатый опыт реализация намеченных плановых заданий представляет собой интересный эксперимент проверки форм развития.</div>--}}
{{--            </div>--}}
{{--        </div>--}}
        @if($primary_categories)
            @foreach($primary_categories as $category)
                <h3 class="text-center">{{ $category->title }}</h3>
                <div class="blockcontent-list" id="{{ $category->slug }}">
                    <div class="body">
                        @php $sub_num = 1 @endphp
                        @foreach($category->subCategory as $subCategory)
                            <div class="sub-category">
                                <div class="head">{{ $subCategory->title }}</div>
                                @php $rule_num = 1 @endphp
                                @foreach($subCategory->rules as $rule)
                                    <div class="element">
                                        <div>
                                            <span>{{ $sub_num }}.{{ $rule_num++ }}</span>
                                            {{ $rule->text }}
                                        </div>
                                        <small>{{ $rule->penalty ?? null }}</small>
                                    </div>
                                @endforeach
                                @php $sub_num++ @endphp
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <h3 class="text-center">Rules not find :(</h3>
        @endif
    </section>
@endsection

@if($primary_categories)
    @section('sidebar')
        @foreach($primary_categories as $category)
        <a href="{{ route('rules.list').'#'.$category->slug }}">
            <span class="sidebar-description">{{ $category->title }}</span>
        </a>
        @endforeach
    @endsection
@endif

@section('javascript')
    <script>
        function setId(curLoc){
            location.hash = '#' + curLoc;
            try {
                history.pushState(null, null, location.hash);
            } catch(e) {
                console.log(e)
            }
        }

        $(".nav-link[data-toggle|='pill']").click(function () {
            var pill = $(this);
            setId(pill.attr('id'))
        });

        $(document).ready(function () {
            var url = window.location.href;
            var id = url.substring(url.lastIndexOf('#'));
            $(id).tab('show');
        })
    </script>
@endsection
