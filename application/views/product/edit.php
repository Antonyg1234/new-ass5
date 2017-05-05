<body>
<!--wrapper-starts-->
<div id="wrapper">

    <!--header-starts-->
    <header class="clearfix">

        <div class="container"><!--container Start-->

            <div class="Logo_Cont left"><!--Logo_Cont Start-->

                <a href="index.html"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt=""  /></a>

            </div><!--Logo_Cont End-->

            <div class="Home_Cont_Right right"><!--Home_Cont_Right Start-->

                <div class="Home_Cont_Right_Top left"><!--Home_Cont_Right_Top Start-->

                    <div class="Top_Search1 left">Call Us Today! (02) 9017 8413</div>
                    <div class="Top_Search2 right"><input  id="tags1" name="" type="text" onclick="this.value='';" onblur="validate_field('phone');"  value="Type desired Job Location" /></div>

                </div><!--Home_Cont_Right_Top End-->

                <div class="Home_Cont_Right_Bottom left"><!--Home_Cont_Right_Bottom Start-->
                    <div class="toggle_menu"><a href="javascript:void(0)">Menu</a></div>
                    <div id= "topMenu">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="blog_index.html">Dating Blog</a></li>
                            <li><a href="who_we_help.html">Who We Help</a></li>
                            <li><a href="why_vital.html">Why Vital</a></li>
                            <li><a href="reviews.html">Reviews</a></li>
                            <li><a href="contact_us.html">Contact Us</a></li>
                        </ul>
                    </div>

                </div><!--Home_Cont_Right_Bottom End-->

            </div><!--Home_Cont_Right End-->

        </div><!--container End-->

    </header>
    <!--header-ends-->

    <div class="section banner_section who_we_help">
        <div class="container">
            <h4>Add Product</h4>
        </div>
    </div>

    <!-- Content Section Start-->
    <div class="section content_section">
        <div class="container">
            <?php echo form_open_multipart('product/edit/'.$id); ?>
            <div class="filable_form_container">

                <div class="form_container_block">
                    <ul>
                        <li class="fileds">
                            <div class="name_fileds">
                                    <span class="success">
                                <?php
                                if (isset($this->session))
                                {
                                    echo $this->session->flashdata('success');
                                }
                                ?>
                                    </span>
                               
                                <label>Product Name<span class="required">  *<?php echo form_error('product'); ?></span></label>
                                <input name="product" id="product" type="text" value="<?php echo $product_data->productname;?>" />
                            </div>
                        </li>
                        <li class="fileds">
                            <div class="name_fileds">
                                <label>Product Price<span class="required">  *<?php echo form_error('price'); ?></span></label>
                                <input name="price" id="price" type="text" value="<?php echo $product_data->price;?>" />
                            </div>
                        </li>
                        <li class="fileds">
                            <div class="upload_fileds">
                                <label>Upload Image<span class="required"> </span></label>
                                <input name="uploadedimage" id="uploadedimage" type="file" placeholder="Choose File" class="mandatory_fildes" value="upload" >

                            </div>
                        </li>
                        <li class="fileds">
                            <div class="name_fileds">
                                <label>Select Category<span class="required">  *<?php echo form_error('category_select'); ?></span></label>
                                <select id="category_select" name="category_select" class="select category">
                                    <option value="<?php echo $product_data->id;?>"><?php echo $product_data->name;?></option>
                                    <?php
                                    foreach ($dropdown->result() as $row)
                                    {
                                        ?>
                                        <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                                    <?php	} ?>
                                </select>
                            </div>
                        </li>
                    </ul>
                    <div class="next_btn_block">
                        <div class="next_btn">
                            <input type="submit" name="submit" id="submitbox" value="Submit"></input>
                            <a href="<?php echo base_url(); ?>index.php/product" class="back-btn"><span><<</span>Back</a>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Content Section End-->




    <div class="section clearfix section-colored7"><!--section start-->

        <div class="container"><!--container Start-->

            <div class="Download_Cont_Top_Left left"><!--Download_Cont_Top Start-->
                <img src="images/icon5.png" alt=""> <h1 style="display:inline;">FREE: Men Are From Mars</h1> <a href="#">Download Now</a>

            </div><!--Download_Cont_Top End-->

        </div><!--container End-->

    </div><!--section End-->



    <script type="text/javascript">
        $(document).ready(function(){
            $('.select').each(function(){
                var title = $(this).attr('title');
                if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
                $(this).css({'z-index':10,'opacity':0,'-khtml-appearance':'none'}).after('<span class="select">' + title + '</span>').change(function(){
                    val = $('option:selected',this).text();
                    $(this).next().text(val);
                })
            });
        });
    </script>