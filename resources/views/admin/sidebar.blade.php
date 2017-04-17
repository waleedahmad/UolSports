<div class="sidebar col-xs-12 col-sm-3 col-md-3 col-lg-2">
    <ul class="links">
        <li @if(Request::path() === 'admin') class="active" @endif>
            <a href="/">Verification Requests</a>
        </li>

        <li @if(Request::path() === 'admin/users') class="active" @endif >
            <a href="/admin/users">
                Users
            </a>
        </li>

        <li @if(Request::path() === 'admin/sports') class="active" @endif>
            <a href="/admin/sports">
                Sports
            </a>
        </li>

        <li @if(Request::path() === 'admin/players') class="active" @endif>
            <a href="/admin/players">
                Players
            </a>
        </li>

        <li @if(Request::path() === 'admin/trial/requests') class="active" @endif>
            <a href="/admin/trial/requests">
                Join Requests
            </a>
        </li>

        <li @if(Request::path() === 'admin/trials') class="active" @endif>
            <a href="/admin/trials">
                Trials
            </a>
        </li>

        <li @if(Request::path() === 'admin/teams') class="active" @endif>
            <a href="/admin/teams">
                Teams
            </a>
        </li>

        <li @if(Request::path() === 'admin/events') class="active" @endif>
            <a href="/admin/events">
                Events
            </a>
        </li>
    </ul>
</div>