<div class="sidebar col-xs-12 col-sm-12 col-md-2 col-lg-2">
    <div class="user-box">
        <div class="col-xs-3">
            <div class="image-holder">
                <img src="/storage/{{Auth::user()->image_uri}}" alt="">
            </div>
        </div>

        <div class="col-xs-9">
            {{Auth::user()->name}}
        </div>
    </div>

    <div class="title-divider">
        Shortcuts
    </div>

    <div class="navigator">

        <a href="/" class="link  @if(Request::path() === '/') active @endif">
            Events
        </a>

        <a href="/teams" class="link @if(Request::path() === 'teams') active @endif">
            Teams
        </a>

        <a href="/trials/requests" class="link @if(Request::path() === 'trials/requests') active @endif">
            Trial Requests
        </a>
    </div>


    <div class="title-divider">
        Participative Sports
    </div>

    <div class="sports">
        @if($your_sports->count())
            {{$your_sports}}
        @else
            You're not participating in any sports.
        @endif
    </div>

    <div class="title-divider">
        Other Sports
    </div>

    <div class="sports">
        @if($other_sports->count())
            @foreach($other_sports as $sport)
                <div class="sport">
                    {{$sport->name}}

                    <span class="@if($sport->requestPending()) waiting-approval @else request-trial @endif pull-right" data-id="{{$sport->id}}" data-name="{{$sport->name}}">
                                @if($sport->requestPending())
                            Waiting approval
                        @else
                            Request Trial
                        @endif
                            </span>
                </div>
            @endforeach
        @else
            No new sports are available for participation.
        @endif
    </div>
</div>