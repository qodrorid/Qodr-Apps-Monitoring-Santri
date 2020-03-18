@php($total = 0)
@foreach($cashflow as $item)
@php($total = $total + $item->debit - $item->kredit)
<tr id="row-cashflow-{{ $item->id }}" {!! $disable ? 'class="disabled-row"' : '' !!}>
    <td align="center">{{ $loop->iteration }}</td>
    <td>{{ $item->dateIndo() }}</td>
    <td>{{ $item->for }}</td>
    <td align="center">{{ $item->qty }}</td>
    <td align="center">{{ $item->type }}</td>
    <td align="right">{!! HelperView::currency($item->price) !!}</td>
    <td align="right">{!! HelperView::currency($item->debit) !!}</td>
    <td align="right">{!! HelperView::currency($item->kredit) !!}</td>
    <td align="right">{!! HelperView::currency($total) !!}</td>
    <td class="action" align="center">
        @php($dataEdit = $item->toArray())
        @php($dataEdit['total'] = $total)
        @if (!$disable)
        <button type="button" class="btn btn-primary btn-sm pr-2" onclick="edit({{ $item->id }}, '{{ json_encode($dataEdit) }}')">
            <i class="feather icon-edit"></i>
        </button>
        <button type="button" class="btn btn-danger btn-sm pr-2" onclick="deleted({{ $item->id }})">
            <i class="feather icon-trash-2"></i>
        </button>
        @endif
    </td>
</tr>
@endforeach
<tr>
    <td colspan="6" align="right"><b>TOTAL</b></td>
    <td align="right"><b>{!! !empty($parent->debit) ? HelperView::currency($parent->debit) : HelperView::currency(0) !!}</b></td>
    <td align="right"><b>{!! !empty($parent->kredit) ? HelperView::currency($parent->kredit) : HelperView::currency(0) !!}</b></td>
    <td align="right"><b>{!! !empty($parent->total) ? HelperView::currency($parent->total) : HelperView::currency(0) !!}</b></td>
    <td></td>
</tr>