// CKEditor configuration for Laravel Blade templates. Adds a text editor to things like story previews, etc.
// Remember when using this to link to the CKEditor Classic Editor CDN on the page you are using this.
// Configuration for CKEditor in Vue components is handled separately.
// CP 5/29/23

document.addEventListener('DOMContentLoaded', () => {
	ClassicEditor
	.create(document.querySelector('#cktextarea'), {
		toolbar: {
			items: ['heading', '|', 'bold', 'italic', 'link', '|', 'undo', 'redo']
		}
	})
	.catch(error => {
		console.error(error);
	});
})
