import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function Save({ attributes }) {
	const { title, description, image_url, image_alt, image_title, image_id } =
		attributes;

	return (
		<div {...useBlockProps.save()}>
			{image_url && (
				<img
					src={image_url}
					alt={image_alt || ''}
					{...(image_title ? { title: image_title } : {})}
					{...(image_id ? { id: String(image_id) } : {})}
				/>
			)}
			<RichText.Content tagName="h2" value={title} />
			<RichText.Content tagName="p" value={description} />
		</div>
	);
}
