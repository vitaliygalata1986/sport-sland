import {useBlockProps} from "@wordpress/block-editor";
import './editor.scss'; // импорт стилей для редактора
export default function edit() {
    const blockProps = useBlockProps();
    return <h1 {...blockProps}>Edit 2</h1>;
}