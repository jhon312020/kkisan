<select name="ItemID" id="ItemID" class="form-control">
  <option value="">Choose an Item</option>
  @if ($items)
  @foreach ($items as $item)
  <option value="{{ $item->ItemID }}">{{ $item->ItemName }}</option>
  @endforeach
  @endif
</select>