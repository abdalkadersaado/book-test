<div class="wn__sidebar">
    <aside class="widget recent_widget">
        <ul>
            <li class="list-group-item">
                <img src="{{ asset('assets/users/default.png') }}" alt="{{ auth()->user()->name }}">
            </li>

            <li class="list-group-item"><a href="{{ route('frontend.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
        </ul>
    </aside>
</div>
