import { useBlockProps } from '@wordpress/block-editor'; // { useBlockProps } from '@wordpress/block-editor'; // react hook в котором хранятся свойства блока (классы, id, data-атрибуты и т.д.)

export default function save() {
	const blockProps = useBlockProps.save(); // на фронте дефолтных свойств не будет
	return <h1 { ...blockProps }>Save 2</h1>;
}
