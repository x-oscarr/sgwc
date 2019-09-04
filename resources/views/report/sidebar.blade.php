<a href="{{ route('report.list') }}">
    <i class="fas fa-list"></i>
    <span class="sidebar-dectription">Reports list</span>
</a>
@if(Auth::user())
    <a href="#">
        <i class="fas fa-exclamation-triangle"></i>
        <span class="sidebar-dectription">My reports</span>
    </a>
    <a href="#">
        <i class="fas fa-ban"></i>
        <span class="sidebar-dectription">Punishments</span>
    </a>
@endif
