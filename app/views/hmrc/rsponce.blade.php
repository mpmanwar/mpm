 
 
 
 @if(isset($datares) && count($datares) >0)
                        
                        
                        
                        <select class="form-control">
                        
                         @foreach($datares as $key=>$name_row)
                        
                        <option value="">{{ $name_row }}</option>
                        
                        
                        
                        @endforeach
                        </select>
                      @endif
                      
                      
                      
                   