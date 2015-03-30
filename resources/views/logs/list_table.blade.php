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
        <td class="cell-condensed">
          {{ $log->id }}
        </td>
        <td>
          {{ link_to("logs/{$log->id}", $log->title) }}
        </td>
        <td>
          @if (!empty($log->profile->first_name) && !empty($log->profile->last_name))
            {{ $log->profile->first_name.' '.$log->profile->last_name }}
          @else
            {{ $log->user->username or '' }}
          @endif
        </td>
        <td>
          {{ $log->system }}
        </td>
        <td>
          {{ $log->type }}
        </td>
        <td class="cell-condensed">
          {{ $log->updated_at }}
        </td>
        <td class="cell-condensed">
          {{ $log->created_at }}
        </td>
        <td class="cell-condensed">
          <button class="icon_email text_button confirm" data-action="mailto:?subject={{ rawurlencode('Activity Log: '.$log->title) }}&body={{ rawurlencode($log->content) }}">Email</button>
          <button class="icon_edit text_button confirm" data-action="{{ url("logs/{$log->id}/edit") }}">Edit</button>
          {{ Form::open(array('route' => array('logs.destroy', $log->id),'method' => 'DELETE','class' => 'inline')) }}
            {{ Form::button('Delete',array('class' => 'icon_trash_thin text_button confirm','type' => 'submit')) }}
          {{ Form::close() }}
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  @if (method_exists($logs, 'links'))
    {{ $logs->links() }}
  @endif
@endif
