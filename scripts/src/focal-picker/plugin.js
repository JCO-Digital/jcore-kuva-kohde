import { __ } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';
import { registerPlugin } from '@wordpress/plugins';
import { PluginPostStatusInfo } from '@wordpress/editor';
import { FocalPointPicker } from '@wordpress/components';

export const FeaturedFocalPointPickerPanel = () => {
	const postType = useSelect((select) => {
		const editor = select('core/editor');
		return editor.getCurrentPostType();
	});

	const [meta, setMeta] = useEntityProp('postType', postType, 'meta');

	const imageObj = useSelect((select) => {
		const editor = select('core/editor');
		const imageId = editor.getEditedPostAttribute('featured_media');
		return select('core').getMedia(imageId);
	});

	const url = imageObj?.source_url ?? undefined;
	const setFeaturedImageMeta = (val) => {
		setMeta({ ...meta, jcore_focal_point: val });
	};

	if (!postType) {
		return null;
	}

	if (!meta) {
		return null;
	}

	if (!url) {
		return null;
	}

	return (
		<PluginPostStatusInfo className="focal-point-picker">
			{url && (
				<>
					<FocalPointPicker
						label={__('Focal point picker')}
						url={url}
						value={meta.jcore_focal_point}
						onChange={(newFocalPoint) =>
							setFeaturedImageMeta(newFocalPoint)
						}
					/>
				</>
			)}
		</PluginPostStatusInfo>
	);
};

registerPlugin('jcore-focal-point-picker', {
	render: FeaturedFocalPointPickerPanel,
	icon: 'image',
});
