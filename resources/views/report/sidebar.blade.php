<a href="{{ route('report.list') }}">
    <i class="fas fa-list"></i>
    <span class="sidebar-description">Reports list</span>
</a>
<a href="{{ route('report.add') }}">
    <i class="fas fa-plus"></i>
    <span class="sidebar-description">Create report</span>
</a>
@if(Auth::user())
    <a href="{{ route('report.my-reports') }}">
        <i class="fas fa-exclamation-triangle"></i>
        <span class="sidebar-description">My reports</span>
    </a>
    <a href="{{ route('report.punishments') }}">
        <i class="fas fa-ban"></i>
        <span class="sidebar-description">Punishments</span>
    </a>
@endif
