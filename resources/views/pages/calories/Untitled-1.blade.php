 <div class="col-12" id="addSection">
                                            <div class="row" id="repeatSection">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Macro (Count as)</label>
                                                        <div class="select2-purple">
                                                            <select name="submacro" id=""
                                                                class="form-control select2bs4" style="width: 100%;">
                                                                @foreach ($macros as $macro)
                                                                    <option value="{{ $macro->id }}"
                                                                        {{ old('macro') == $macro->id ? 'selected' : '' }}>
                                                                        {{ $macro->countas }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- /.form-group -->
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Macro (Count as)</label>
                                                        <div class="select2-purple">
                                                            <select name="submacro" id=""
                                                                class="form-control select2bs4" style="width: 100%;">
                                                                @foreach ($macros as $macro)
                                                                    <option value="{{ $macro->id }}"
                                                                        {{ old('macro') == $macro->id ? 'selected' : '' }}>
                                                                        {{ $macro->countas }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- /.form-group -->
                                                </div>
                                            </div>
                                        </div>