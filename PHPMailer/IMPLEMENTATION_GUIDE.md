# Google Maps Location Picker Implementation Guide

## Overview
This guide explains the new Google Maps location picker feature added to your Paris Fast Transfer booking system. Two main features have been implemented:

1. **Google Maps Location Picker** in `book-ride.php` - Visual map-based location selection
2. **Conditional Return Fields** in `thankyou.html` - Hide return details when pickup type is "One way"

---

## Feature 1: Google Maps Location Picker (book-ride.php)

### What's New
- **Location Icon Buttons** next to "Pickup Location" and "Drop Off Location" fields
- **Interactive Map Modal** opens when clicking the location icons
- **Visual Location Selection** - Click on the map to select a location
- **Search Functionality** - Type location names to search and auto-complete
- **Predefined Locations** - Quick buttons for common locations (Paris, Disneyland, CDG, Orly, Beauvais)
- **Draggable Marker** - Drag the marker on the map to adjust the location
- **Address Auto-Complete** - Still works with the original Google Places autocomplete

### UI Elements

#### Location Icon Button
```html
<button type="button" class="location-icon-btn" id="pickup-map-btn" title="Select from Map">
    <i class="fas fa-map-location-dot"></i>
</button>
```
- Positioned at the right side of each location input field
- Color: Orange (#FF6B35)
- Hovers with scale animation
- Prevents default form submission behavior

#### Map Modal
The modal includes:
- **Header** - Title showing which location type is being selected (Pickup/Drop-off)
- **Search Bar** - Type location names and press Enter to search
- **Predefined Buttons** - Quick access to common Paris locations
- **Google Map** - Interactive map with clickable locations
- **Footer** - Cancel and Select Location buttons
- **Location Info Display** - Shows currently selected address

### How to Use

#### For Users:
1. **Click the location icon** next to "Pickup Location : Address with City" field
2. **Choose one of three ways to select a location:**
   - **Click on Map** - Click anywhere on the map to place the marker
   - **Use Search Bar** - Type a location name and press Enter
   - **Click Predefined Button** - Click Paris, Disneyland, CDG, Orly, or Beauvais buttons
3. **Drag the Marker** (optional) - Adjust the pin by dragging it
4. **Click "Select Location"** button to confirm selection
5. The address will automatically populate in the input field
6. Repeat for drop-off location

#### Example Workflow:
```
User → Clicks location icon → Map modal opens → Clicks "Disneyland" button → 
Marker moves to Disneyland → Clicks "Select Location" → Address fills in field
```

### CSS Styling

**Location Icon Button Styles:**
```css
.location-icon-btn {
    position: absolute;
    right: 12px;
    top: 42px;
    background: none;
    border: none;
    cursor: pointer;
    color: #FF6B35;
    font-size: 18px;
    transition: all 0.3s ease;
}
```

**Map Modal Styles:**
- Overlay background: Semi-transparent black (rgba(0, 0, 0, 0.5))
- Modal width: 90% (max 900px)
- Border radius: 12px with smooth animations
- Responsive design for mobile devices

**Predefined Location Buttons:**
- Grid layout: Auto-fitting columns
- Hover effect: Orange background with white text
- Selected state: Persistent orange highlighting

### Technical Implementation

#### JavaScript Functions:
1. **`initMap()`** - Initializes Google Map
2. **`addMarkerToMap(location)`** - Adds/updates marker
3. **`selectLocationFromMap(latLng)`** - Reverse geocodes clicked location
4. **`openMapModal(type)`** - Opens modal for pickup/dropoff
5. **`closeMapModal()`** - Closes modal and clears selection
6. **`applyLocation()`** - Applies selected location to input field
7. **Predefined location handlers** - Geocodes preset locations
8. **Search functionality** - Geocodes user-typed locations

#### Key Features:
- Uses Google Maps Geocoding API
- Reverse geocoding for clicked locations
- Forward geocoding for search/predefined locations
- Marker drag functionality
- Real-time display of selected address
- Form integration (changes trigger form validation)

### Important: Google Maps API Key

The code requires a Google Maps API with the following libraries:
- `maps` - Core Maps API
- `places` - Places API for autocomplete

**Find this line in book-ride.php (around line 1207):**
```html
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places&callback=initGoogleMapsAutocomplete" async defer></script>
```

**Replace `YOUR_GOOGLE_MAPS_API_KEY` with your actual API key:**
```html
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_ACTUAL_KEY_HERE&libraries=places&callback=initGoogleMapsAutocomplete" async defer></script>
```

### Browser Compatibility
- Chrome/Edge: ✅ Full support
- Firefox: ✅ Full support
- Safari: ✅ Full support (iOS 10+)
- IE11: ❌ Not supported (uses modern JavaScript)

---

## Feature 2: Conditional Return Fields (thankyou.html)

### What's Changed
The thank you page now **automatically hides return-related fields** when the user selects "One way" as the pickup type.

### Hidden Fields (when pickup type = "One way"):
- Return Pickup Address
- Return Dropoff Address
- Return Date
- Return Time

### Implementation

#### HTML Changes:
Added CSS classes to return field items:
```html
<div class="item return-field" id="return-item-1">
    <h4>Return Pickup Address</h4>
    <div id="v-return-pickup-address">-</div>
</div>
```

#### JavaScript Logic:
```javascript
// Hide return fields if pickup type is "One way"
var pickupType = get('pickuptype').trim();
if (pickupType && pickupType.toLowerCase() === 'one way') {
    var returnFields = document.querySelectorAll('.return-field');
    returnFields.forEach(function(field) {
        field.style.display = 'none';
    });
}
```

### How It Works:

1. **User Books a Ride** with pickup type "One way"
2. **Form Submits** with pickuptype parameter
3. **Redirect to thankyou.html** with URL parameters
4. **JavaScript Reads** the pickuptype parameter from URL
5. **If pickuptype = "One way":**
   - Return fields automatically hidden
   - Page shows only relevant booking details
6. **If pickuptype = "Return":**
   - All fields displayed
   - User can see both outbound and return details

### URL Parameter Example:
```
thankyou.html?name=John&phone=+331234&pickup=Paris&dropoff=Disneyland&...&pickuptype=One%20way
```

### Styling Note:
The hidden fields use `display: none` which:
- Removes them from the DOM flow
- Prevents layout shifts
- Improves visual cleanliness

---

## Files Modified

### 1. **book-ride.php**
**Changes:**
- Added location input wrapper divs with class `location-input-wrapper`
- Added location icon buttons (pickup-map-btn, dropoff-map-btn)
- Added comprehensive CSS for modal, buttons, and styling
- Added Google Maps location picker modal HTML
- Added JavaScript for map initialization and interactions

**New CSS Classes:**
- `.location-input-wrapper` - Wrapper for input fields
- `.location-icon-btn` - Location picker button
- `.map-modal` - Main modal container
- `.map-modal-content` - Modal content box
- `.map-modal-header` - Modal header
- `.map-modal-body` - Modal body with map
- `.map-search-wrapper` - Search input area
- `.predefined-locations` - Quick access buttons grid
- `.location-btn` - Individual location button
- `.map-modal-footer` - Modal footer with action buttons

**New JavaScript Functions:**
- Location picker modal management
- Google Maps integration
- Geocoding functionality
- Marker placement and dragging
- Location search and selection

### 2. **thankyou.html**
**Changes:**
- Added `return-field` CSS class to return-related item divs
- Added unique IDs to return field items (return-item-1 through return-item-4)
- Updated JavaScript to read pickuptype parameter
- Added conditional logic to hide return fields when pickuptype="One way"

**Modified JavaScript:**
- Enhanced `DOMContentLoaded` event handler
- Added return fields visibility control
- Added pickup type checking logic

---

## Customization Guide

### Change Predefined Locations:
In book-ride.php, find the predefined locations section (~line 1202):
```html
<div class="predefined-locations" id="predefined-locations">
    <button type="button" class="location-btn" data-location="Paris, France">Paris</button>
    <button type="button" class="location-btn" data-location="Disneyland Paris, France">Disneyland</button>
    <!-- Add more buttons here -->
</div>
```

### Change Modal Colors:
Find the gradient background in CSS (~line 115):
```css
background: linear-gradient(135deg, #FF6B35 0%, #FF8555 100%);
```
Change `#FF6B35` and `#FF8555` to your desired colors.

### Change Modal Size:
Find the modal width in CSS (~line 135):
```css
max-width: 900px; /* Change this value */
```

### Change Default Map Center:
Find the default center in JavaScript (~line 1225):
```javascript
const defaultCenter = { lat: 48.8566, lng: 2.3522 }; // Paris coordinates
```

---

## Troubleshooting

### Map Modal Not Opening:
- **Check:** Google Maps API key is valid and has Maps + Places libraries enabled
- **Check:** Console for JavaScript errors (F12 → Console tab)
- **Check:** CSS is not being overridden by other styles

### Locations Not Appearing:
- **Check:** Google Maps API key has Geocoding API enabled
- **Check:** Location names in predefined buttons are valid
- **Check:** Network tab shows successful API calls

### Icons Not Showing:
- **Check:** FontAwesome is properly loaded
- **Check:** Icon names are correct (`fas fa-map-location-dot`)
- **Check:** CSS is being applied correctly

### Return Fields Not Hiding:
- **Check:** Pickup type parameter is being passed correctly in URL
- **Check:** Parameter name is exactly `pickuptype` (case-sensitive in get function)
- **Check:** Value is exactly "One way" (case-insensitive due to `.toLowerCase()`)
- **Check:** JavaScript console shows no errors

---

## Mobile Responsiveness

Both features are fully responsive:

### Mobile Optimizations:
1. **Location Buttons:**
   - Icon size adjusts on small screens
   - Touch-friendly tap targets (minimum 44px)

2. **Map Modal:**
   - Expands to 95% width on mobile
   - Height adjusts to 95vh
   - Touch-friendly buttons
   - Responsive grid layout for predefined buttons

3. **Predefined Location Grid:**
   - Adjusts columns from 5 to 2-3 on smaller screens
   - Proper spacing maintained
   - Scrollable if needed

---

## Testing Checklist

- [ ] Location icon buttons appear next to address fields
- [ ] Clicking location icon opens map modal
- [ ] Map displays correctly and is interactive
- [ ] Predefined location buttons work
- [ ] Clicking on map places a marker
- [ ] Marker can be dragged
- [ ] Search functionality works
- [ ] Selected location populates the input field
- [ ] Modal closes properly
- [ ] Return fields hide when pickuptype="One way"
- [ ] Return fields show when pickuptype="Return"
- [ ] All features work on mobile devices
- [ ] No JavaScript errors in console
- [ ] Form still submits correctly

---

## Support & Questions

If you encounter any issues:
1. Check browser console for errors (F12 → Console)
2. Verify Google Maps API key configuration
3. Ensure all files are in correct locations
4. Check that both CSS and JavaScript are fully loaded
5. Test in different browsers for compatibility

---

## Version Information
- **Implementation Date:** May 2026
- **Files Updated:** 2 (book-ride.php, thankyou.html)
- **Breaking Changes:** None
- **Backward Compatible:** Yes

