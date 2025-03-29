import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import './editor.scss';

export default function Edit() {
	return (
		<div {...useBlockProps()}>
			<InnerBlocks allowedBlocks={['vitos/myblock']} />
		</div>
	);
}

// allowedBlocks={['core/image']} - разрешаем добавлять только картинки
