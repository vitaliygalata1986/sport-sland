import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import Edit from './edit';
import Save from './save';

registerBlockType('vitos/myblock', {
	title: __('My Block', 'myblock'),
	description: 'Single Block',
	icon: 'universal-access',
	parent: ['vitos/myblocks'], // разрешить показывать блок vitos/myblocks внутри блока vitos/myblocks
	supports: {
		html: false, // отключим конвертацию в HTML
		reusable: false, // отключим возможность повторного использования
	},
	attributes: {
		title: {
			// заголовок
			type: 'string',
			source: 'html', // чтобы не дублировались данные в атрибутах
			selector: 'h2',
		},
		description: {
			// описание
			type: 'string',
			source: 'html',
			selector: 'p',
		},
		image_url: {
			type: 'string',
			source: 'attribute',
			selector: 'img',
			attribute: 'src',
		},
		image_alt: {
			type: 'string',
			source: 'attribute',
			selector: 'img',
			attribute: 'alt',
			default: '',
		},
		image_title: {
			type: 'string',
			source: 'attribute',
			selector: 'img',
			attribute: 'title',
			default: '',
		},
		image_id: {
			type: 'number',
		},
	},
	edit: Edit,
	save: Save,
});
