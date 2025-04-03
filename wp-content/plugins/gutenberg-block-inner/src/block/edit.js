import {
  useBlockProps,
  RichText,
  MediaPlaceholder,
  BlockControls,
  MediaReplaceFlow,
  InspectorControls,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { isBlobURL } from '@wordpress/blob';
import {
  Spinner,
  ToolbarButton,
  PanelBody,
  TextControl,
} from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
  const { title, description, image_url, image_alt, image_title, image_id } =
    attributes;

  const onSelectURL = (val) => {
    setAttributes({
      image_id: undefined,
      image_url: val,
      image_alt: '',
    });
  };
  const onSelect = (val) => {
    setAttributes({
      image_id: val.id,
      image_url: val.url,
      image_alt: val.alt,
      image_title: val.title,
    });
  };

  return (
    <>
      {image_url && !isBlobURL(image_url) && (
        <InspectorControls>
          <PanelBody title={__('Settings for Image', 'myblocks')}>
            <TextControl
              label={__('Change Alt', 'myblocks')}
              value={image_alt}
              help={__('Change alt text', 'myblocks')}
              onChange={(val) => setAttributes({ image_alt: val })}
            />
            <TextControl
              label={__('Change Title', 'myblocks')}
              value={image_title}
              help={__('Change title text', 'myblocks')}
              onChange={(val) => setAttributes({ image_title: val })}
            />
          </PanelBody>
        </InspectorControls>
      )}
      {image_url && ( // если картинка установлена, то показываем контролы
        <BlockControls>
          <MediaReplaceFlow
            name={__('Replace Image', 'myblocks')}
            onSelect={onSelect}
            onSelectURL={onSelectURL}
            accept='image/*'
            allowedTypes={['image']}
            mediaId={image_id}
            mediaURL={image_url}
          />
          <ToolbarButton
            onClick={() =>
              setAttributes({
                image_id: undefined,
                image_url: undefined,
                image_alt: '',
              })
            }
          >
            {__('Remove Image', 'myblocks')}
          </ToolbarButton>
        </BlockControls>
      )}
      <div {...useBlockProps()}>
        {image_url && (
          <div
            className={`image ${isBlobURL(image_url) ? 'is-loading' : 'loaded'}`}
          >
            <img src={image_url} alt={image_alt} id={image_id} />
            {isBlobURL(image_url) && <Spinner />}
          </div>
        )}
        <MediaPlaceholder
          onSelect={onSelect}
          onSelectURL={onSelectURL}
          accept='image/*'
          allowedTypes={['image']}
          disableMediaButtons={image_url}
        />
        <RichText
          tagName='h2'
          allowedFormats={[]}
          value={title}
          placeholder={__('Your Title', 'myblocks')}
          onChange={(val) => setAttributes({ title: val })}
        />
        <RichText
          tagName='p'
          allowedFormats={[]}
          value={description}
          placeholder={__('Your Description', 'myblocks')}
          onChange={(val) => setAttributes({ description: val })}
        />
      </div>
    </>
  );
}
