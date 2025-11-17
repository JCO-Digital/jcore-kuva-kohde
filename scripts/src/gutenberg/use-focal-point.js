import { createHigherOrderComponent } from '@wordpress/compose';
import { InspectorAdvancedControls } from '@wordpress/block-editor';
import { ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { addFilter } from '@wordpress/hooks';
import { EXTENDED_BLOCKS } from './consts';

/**
 * Add mobile visibility controls on Advanced Block Panel.
 *
 * @param {function} BlockEdit Block edit component.
 *
 * @return {function} BlockEdit Modified block edit component.
 */
const withFocalPointControl = createHigherOrderComponent((BlockEdit) => {
	return (props) => {
		if (!EXTENDED_BLOCKS.includes(props.name)) {
			return <BlockEdit {...props} />;
		}

		const { attributes, setAttributes, isSelected } = props;

		const { useFocalPoint } = attributes;

		return (
			<>
				<BlockEdit {...props} />
				{isSelected && (
					<InspectorAdvancedControls>
						<ToggleControl
							label={__('Use Focal Point')}
							checked={!!useFocalPoint}
							onChange={() =>
								setAttributes({
									useFocalPoint: !useFocalPoint,
								})
							}
							help={
								!!useFocalPoint
									? __('Using focal point.')
									: __('Not using focal point.')
							}
						/>
					</InspectorAdvancedControls>
				)}
			</>
		);
	};
}, 'withFocalPointControl');

addFilter(
	'editor.BlockEdit',
	'jcore/focal-point-editor',
	withFocalPointControl
);
