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
			source: 'html', // чтобы не дубоировались данные в атрибутах
			selector: 'h2',
		},
		description: {
			// описание
			type: 'string',
			source: 'html',
			selector: 'p',
		},
	},
	edit: Edit,
	save: Save,
});
