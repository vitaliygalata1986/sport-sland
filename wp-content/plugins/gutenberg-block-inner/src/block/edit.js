import {
	useBlockProps,
	RichText,
	MediaPlaceholder,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

export default function Edit({ attributes, setAttributes }) {
	const { title, description, image_url, image_alt, image_title, image_id } =
		attributes;
	return (
		<div {...useBlockProps()}>
			{image_url && <img src={image_url} alt={image_alt} id={image_id} />}

			<MediaPlaceholder
				onSelect={(val) =>
					setAttributes({
						image_id: val.id,
						image_url: val.url,
						image_alt: val.alt,
						image_title: val.title,
					})
				}
				onSelectURL={(val) =>
					setAttributes({
						image_id: undefined,
						image_url: val,
						image_alt: '',
						image_title: '',
					})
				}
				accept="image/*"
				allowedTypes={['image']}
				disableMediaButtons={image_url}
			/>
			<RichText
				tagName="h2"
				allowedFormats={[]}
				value={title}
				placeholder={__('Your Title', 'myblocks')}
				onChange={(val) => setAttributes({ title: val })}
			/>
			<RichText
				tagName="p"
				allowedFormats={[]}
				value={description}
				placeholder={__('Your Description', 'myblocks')}
				onChange={(val) => setAttributes({ description: val })}
			/>
		</div>
	);
}
