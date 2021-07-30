<x-modal>
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Product Name</label>
        <div class="col-sm-10">
          <input type="text" name="name" class="form-control" id="name"  required autofocus>
          <span class="help-block with-errors"></span>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="price" class="col-sm-2 col-form-label">Price</label>
        <div class="col-sm-10">
          <input type="number" name="price" class="form-control" id="price"  required autofocus>
          <span class="help-block with-errors"></span>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="merchant_id" class="col-sm-2 col-form-label">Merchant</label>
        <div class="col-sm-10">
            <select class="form-control" name="merchant_id" id="merchant">
                <option selected disabled>Select merchant</option>
                @foreach ($merchant as $item)
                    <option value="{{ $item->id }}">{{ $item->merchant_name }}</option>
                @endforeach
            </select>
            <span class="help-block with-errors"></span>

        </div>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="status" id="status" value="1">
        <label class="form-check-label" for="status">
          Active
        </label>
      </div>
</x-modal>