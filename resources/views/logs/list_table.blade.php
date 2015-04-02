@if ($logs->isEmpty())
  <center><h4>No Logs</h4></center>
@else
  <table class="table">
    <thead>
      <tr>
        <th>
          ID
        </th>
        <th>
          Title
        </th>
        <th>
          Author
        </th>
        <th>
          System
        </th>
        <th>
          Type
        </th>
        <th>
          Last Modified
        </th>
        <th>
          Created
        </th>
        <th>
          Actions
        </th>
      </tr>
    </thead>
    <tbody>
    @foreach ($logs as $log)
        <tr>
        <td class="condensed">
          {{ $log->id }}
        </td>
        <td>
          {!! link_to("logs/{$log->id}", $log->title) !!}
        </td>
        <td>
          @if (!empty($log->creator->first_name) && !empty($log->creator->last_name))
            {{ $log->profile->first_name.' '.$log->profile->last_name }}
          @else
            {{ $log->creator->username or '' }}
          @endif
        </td>
        <td>
          {{ $log->system }}
        </td>
        <td>
          {{ $log->type }}
        </td>
        <td class="condensed">
          {{ $log->updated_at }}
        </td>
        <td class="condensed">
          {{ $log->created_at }}
        </td>
        <td class="condensed">
          <a href="mailto:?subject={{ rawurlencode('Activity Log: '.$log->title) }}&body={{ rawurlencode($log->content) }}">@include('partials.buttons.email')</a>
          <a href="{{ url("logs/{$log->id}") }}">@include('partials.buttons.view')</a>
          <a href="{{ url("logs/{$log->id}/edit") }}">@include('partials.buttons.edit')</a>
          {!! Form::open(['route' => ['logs.destroy', $log->id],'method' => 'DELETE','class' => 'inline']) !!}
            @include('partials.buttons.delete')
          {!! Form::close() !!}
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  @if (method_exists($logs, 'links'))
    {{ $logs->links() }}
  @endif
@endif
