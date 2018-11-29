<div class="row main-section">			
        <div class="col-lg-12 col-md-12">
            <div class="card">

                <div class="card-content">
                <form action="<?php echo base_url();?>environment/import" method="post" enctype="multipart/form-data" accept-charset="utf-8"> 
                    <table class="table form">                                                
                        <thead class="">

                            <tr>
                                <th>Upload File: <span class="required">*</span></th>
                                <th><input type="file"  name="file" id="file" required="" autocomplete="off" placeholder="file" class="form-control"></th>

                            </tr>
                          
                            <tr>
                                <th colspan="2" style="text-align:center">
                                    <button type="submit" name="save" data-id="hello" id="saveEnvironment" class="btn btn-success" value="save"><i class="material-icons">publish</i> Upload</button>
                                     <button type="reset" name="Reset" class="btn btn-info" value="reset"><i class="material-icons">replay</i> Reset</button>
                                </th>
                            </tr>

                        </thead>

                    </table>
                </form>
                </div>
            </div>
        </div>	


</div>


