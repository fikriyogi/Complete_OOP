<?php 	
	include('header.php');

?>

<h3>Tambah Data Barang</h3>
<hr/>
<div class="container">
	<form method="post" action="<?php echo SITE_URL;?>action.php?action=add">

		<div class="row">
			<div class="col-md-8">
				<h2>Add New Post</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 mt-4">
				<div class="form-group">
					<input type="text"  class="form-control" name="title" placeholder="Judul">
				</div>
				<div class="form-group">
					<textarea name="description" id="editor">This is some sample content.</textarea>
				</div>
			</div>
			<div class="col-md-4">

				<div class="form-group">
					<label for="kategori">Status</label>
					<select id="kategori" class="form-control">
						<option>Pilih</option>
					</select>
				</div>
				<div class="form-group">
					<label for="kategori">Kategori</label>
					<select id="kategori" class="form-control">
						<option>Pilih</option>
					</select>
				</div>
				<div class="form-group">
					<label>Featured Image</label>
					<input type="file" name="feat_image"  class="form-control">
				</div>
				<div class="form-group">
					
				</div>
				<div class="form-group">
					
				</div>
				
				<input type="submit" name="tombol" value="Simpan"/>
			</div>
		</div>
	</form>
</div>


<script>
        tinymce.init({
  selector: "textarea",
  plugins: "lists advlist autolink autoresize charmap code emoticons hr image insertdatetime link media paste preview searchreplace table textpattern toc visualblocks visualchars wordcount quickbars",
  toolbar: "code preview | undo redo | formatselect | fontselect | fontsizeselect | bold italic underline strikethrough backcolor | subscript superscript | numlist bullist | alignleft aligncenter alignright alignjustify | outdent indent | paste searchreplace | toc link image media charmap insertdatetime emoticons hr | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol | removeformat",
  insertdatetime_element: true,
   media_scripts: [
   {filter: 'platform.twitter.com'},
   {filter: 's.imgur.com'},
   {filter: 'instagram.com'},
   {filter: 'https://platform.twitter.com/widgets.js'},
 ],
   browser_spellcheck: true,
   contextmenu: false,
});
  </script>
</body>
</html>