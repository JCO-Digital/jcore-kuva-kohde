import { createHigherOrderComponent } from '@wordpress/compose';
import {
	__experimentalText as Text,
	PanelBody,
	FocalPointPicker,
} from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { addFilter } from '@wordpress/hooks';

/**
 * Add mobile visibility controls on Advanced Block Panel.
 *
 * @param {function} BlockEdit Block edit component.
 *
 * @return {function} BlockEdit Modified block edit component.
 */
const withCoreImageFocalPointControl = createHigherOrderComponent(
	(BlockEdit) => {
		return (props) => {
			if (props.name !== 'core/image') {
				return <BlockEdit {...props} />;
			}

			const { attributes, setAttributes } = props;
			const { url, focalPoint } = attributes;

			if (!url || attributes.scale !== 'cover') {
				return <BlockEdit {...props} />;
			}

			return (
				<>
					<BlockEdit {...props} />
					<InspectorControls>
						<PanelBody title="Focal Point">
							<FocalPointPicker
								label={__('Focal point picker')}
								url={url}
								value={focalPoint}
								onChange={(newFocalPoint) =>
									setAttributes({
										...attributes,
										focalPoint: newFocalPoint,
									})
								}
							/>
						</PanelBody>
					</InspectorControls>
				</>
			);
		};
	},
	'withCoreImageFocalPointControl'
);

addFilter(
	'editor.BlockEdit',
	'jcore/core-image-focal-point-editor',
	withCoreImageFocalPointControl
);
