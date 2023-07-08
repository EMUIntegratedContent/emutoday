import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor'
import { Bold, Code, Italic, Strikethrough, Subscript, Superscript, Underline } from '@ckeditor/ckeditor5-basic-styles'
import { RemoveFormat } from '@ckeditor/ckeditor5-remove-format'
import { PasteFromOffice } from '@ckeditor/ckeditor5-paste-from-office'
import { Alignment } from '@ckeditor/ckeditor5-alignment'
import { Heading } from '@ckeditor/ckeditor5-heading'
import { FontSize, FontFamily } from '@ckeditor/ckeditor5-font'
import { FindAndReplace } from '@ckeditor/ckeditor5-find-and-replace'
import { HorizontalLine } from '@ckeditor/ckeditor5-horizontal-line'
import { Table, TableToolbar } from '@ckeditor/ckeditor5-table'
import { SourceEditing } from '@ckeditor/ckeditor5-source-editing'
import { ExportPdf } from '@ckeditor/ckeditor5-export-pdf'
import { SpecialCharacters, SpecialCharactersEssentials } from '@ckeditor/ckeditor5-special-characters'
import { Clipboard } from '@ckeditor/ckeditor5-clipboard'
import { Highlight } from '@ckeditor/ckeditor5-highlight'
import { BlockQuote } from '@ckeditor/ckeditor5-block-quote'
import { MediaEmbed } from '@ckeditor/ckeditor5-media-embed'
import { CodeBlock } from '@ckeditor/ckeditor5-code-block'
import { HtmlEmbed } from '@ckeditor/ckeditor5-html-embed'
import { Image, ImageUpload, ImageToolbar, ImageTextAlternative, ImageResize, ImageStyle, ImageCaption } from '@ckeditor/ckeditor5-image'
import { LinkImage } from '@ckeditor/ckeditor5-link'
import { CloudServices } from '@ckeditor/ckeditor5-cloud-services'
import EssentialsPlugin from '@ckeditor/ckeditor5-essentials/src/essentials'
import LinkPlugin from '@ckeditor/ckeditor5-link/src/link'
import ParagraphPlugin from '@ckeditor/ckeditor5-paragraph/src/paragraph'
import ListPlugin from '@ckeditor/ckeditor5-list/src/list'
import IndentPlugin from '@ckeditor/ckeditor5-indent/src/indent'
import Flmngr from '@edsdk/flmngr-ckeditor5/src/flmngr'
import FileRepository from '@ckeditor/ckeditor5-upload/src/filerepository'
export const ckeditorMixin = {
	data(){
		return {
			editor: ClassicEditor,
			editorConfigFull: {
				height: '500px',
				plugins: [
					FileRepository,
					EssentialsPlugin,
					Bold,
					Code,
					Italic,
					LinkPlugin,
					Strikethrough,
					Subscript,
					Superscript,
					Underline,
					Highlight,
					BlockQuote,
					CodeBlock,
					MediaEmbed,
					HtmlEmbed,
					CloudServices,
					RemoveFormat,
					ParagraphPlugin,
					ListPlugin,
					IndentPlugin,
					PasteFromOffice,
					Alignment,
					Heading,
					FindAndReplace,
					HorizontalLine,
					FontSize,
					FontFamily,
					Table,
					TableToolbar,
					SourceEditing,
					ExportPdf,
					SpecialCharacters,
					SpecialCharactersEssentials,
					Clipboard,
					Flmngr,
					Image,
					ImageToolbar,
					ImageTextAlternative,
					ImageUpload,
					ImageResize,
					ImageStyle,
					ImageCaption,
					MediaEmbed,
					LinkImage
				],
				alignment: {
					options: [ 'left', 'center', 'right', 'justify' ]
				},
				fontSize: {
					options: [
						8,
						10,
						12,
						'default',
						16,
						18,
						20,
						24
					]
				},
				image: {
					styles: [
						'alignCenter',
						'alignLeft',
						'alignRight'
					],
					resizeOptions: [
						{
							name: 'resizeImage:original',
							label: 'Original',
							value: null
						},
						{
							name: 'resizeImage:50',
							label: '50%',
							value: '50'
						},
						{
							name: 'resizeImage:75',
							label: '75%',
							value: '75'
						}
					],
					toolbar: [
						'imageTextAlternative', 'toggleImageCaption', '|',
						'imageStyle:inline', 'imageStyle:wrapText', 'imageStyle:breakText', 'imageStyle:side', '|',
						'resizeImage'
					],
					insert: {
						integrations: [
							'insertImageViaUrl'
						]
					}
				},
				table: {
					contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
				},
				flmngr: {
					urlFileManager: "/flmngr.php",
					urlFiles: "/imgs/uploads/story/images/"
				},
				toolbar: {
					items: [
						'undo', 'redo',
						'|', 'bold', 'italic', 'underline', 'findAndReplace',
						'|', 'strikethrough', 'subscript', 'superscript', 'code', 'removeFormat',
						'|', 'link', 'bulletedList', 'numberedList',
						'|', 'outdent', 'indent',
						'|', 'bulletedList', 'numberedList',
						'|', 'alignment', 'heading', 'fontFamily', 'fontSize',
						'|', 'horizontalLine', 'insertTable', 'exportPdf', 'sourceEditing', 'specialCharacters',
						'|', 'upload', 'flmngr', // 'imgpen',  // Flmngr
						'linkImage',
						'imageUpload',
						{
							label: 'Insert',
							icon: 'plus',
							items: [ 'highlight', 'blockQuote', 'mediaEmbed', 'codeBlock', 'htmlEmbed' ]
						},
					],
					shouldNotGroupWhenFull: true,
				}
			},
			editorConfigSimple: {
				height: '500px',
				plugins: [
					EssentialsPlugin,
					Bold,
					Code,
					Italic,
					LinkPlugin,
					Strikethrough,
					Subscript,
					Superscript,
					Underline,
					Highlight,
					BlockQuote,
					RemoveFormat,
					ParagraphPlugin,
					ListPlugin,
					IndentPlugin,
					PasteFromOffice,
					Alignment,
					Heading,
					FindAndReplace,
					HorizontalLine,
					FontSize,
					FontFamily,
					SpecialCharacters,
					SpecialCharactersEssentials,
					Clipboard
				],
				alignment: {
					options: [ 'left', 'center', 'right', 'justify' ]
				},
				fontSize: {
					options: [
						8,
						10,
						12,
						'default',
						16,
						18,
						20,
						24
					]
				},
				toolbar: {
					items: [
						'undo', 'redo',
						'|', 'bold', 'italic', 'underline', 'findAndReplace',
						'|', 'strikethrough', 'subscript', 'superscript', 'code', 'removeFormat',
						'|', 'link', 'bulletedList', 'numberedList',
						'|', 'outdent', 'indent',
						'|', 'bulletedList', 'numberedList',
						'|', 'alignment', 'heading', 'fontFamily', 'fontSize',
						'|', 'horizontalLine',
						'|',
						{
							label: 'Insert',
							icon: 'plus',
							items: [ 'highlight', 'blockQuote' ]
						},
					],
					shouldNotGroupWhenFull: false,
				}
			}
		}
	}
}
