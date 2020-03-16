@foreach($rab as $item)
<tr>
    <td align="center">{{ $loop->iteration }}</td>
    <td>{{ $item->for }}</td>
    <td align="center">{{ $item->qty }}</td>
    <td align="right">{!! HelperView::currency($item->price) !!}</td>
    <td align="right">{!! HelperView::currency($item->total) !!}</td>
    <td class="action">
        <div class="dropdown-primary dropdown open btn-block">
            <button class="btn btn-primary btn-sm btn-block dropdown-toggle" type="button" id="action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="feather icon-cpu"></i> Action
            </button>
            <div class="dropdown-menu" aria-labelledby="action" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                <a class="dropdown-item" onclick="edit({{ $item->id }})">
                    <i class="feather icon-edit"></i> Edit
                </a>
                <a class="dropdown-item" onclick="deleted({{ $item->id }})">
                    <i class="feather icon-trash"></i> Delete
                </a>
            </div>
        </div>
    </td>
</tr>    
@endforeach