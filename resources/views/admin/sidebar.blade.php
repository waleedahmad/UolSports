<div class="sidebar col-xs-12 col-sm-3 col-md-3 col-lg-2">
    <ul class="links">
        <li @if(Request::path() === 'admin') class="active" @endif>
            <a href="/">Verification Requests</a>
        </li>

        <li @if(Request::path() === 'admin/players') class="active" @endif >
            <a href="/admin/players">
                Players
            </a>
        </li>

        <li @if(Request::path() === 'admin/teams') class="active" @endif>
            <a href="/admin/teams">
                Teams
            </a>
        </li>

        <li @if(Request::path() === 'admin/trials') class="active" @endif>
            <a href="/admin/trials">
                Trials
            </a>
        </li>

        <li @if(Request::path() === 'admin/trial/requests') class="active" @endif>
            <a href="/admin/trial/requests">
                Trial Requests
            </a>
        </li>

        <li @if(Request::path() === 'admin/events') class="active" @endif>
            <a href="/admin/events">
                Events
            </a>
        </li>

        <li @if(Request::path() === 'admin/matches') class="active" @endif>
            <a href="/admin/matches">
                Matches
            </a>
        </li>
    </ul>
</div>