$(document).ready(function () {
    // Generic AJAX Loader for Dropdowns
    window.loadDropdownOptions = function (
        triggerSelectId,
        targetSelectId,
        ajaxUrl,
        options = {}
    ) {
        const $trigger = $(`#${triggerSelectId}`);
        const $target = $(`#${targetSelectId}`);
        const $loader = createLoader($target);

        const startTime = Date.now();

        $target
            .prop("disabled", true)
            .empty()
            .append('<option value="">Loading...</option>');

        $.ajax({
            type: "GET",
            url: ajaxUrl,
            dataType: "json",
            timeout: options.timeout || 10000, // 10s default timeout
            success: function (response) {
                showLoaderDuration($loader, startTime);
                populateDropdown($target, response, options);
            },
            error: function (xhr, status, error) {
                showLoaderDuration($loader, startTime);
                handleAjaxError($target, xhr, status, error, $trigger);
            },
        });
    };

    // Helper functions
    function createLoader($target) {
        // ✅ Inline spinner inside the select (no layout shift)
        $target.html('<option value="">Loading sections...</option>');
        $target.addClass("loading-select");

        // Add inline spinner CSS (no extra elements)
        if (!$("#inline-loader-css").length) {
            $("head").append(`
        <style id="inline-loader-css">
            .loading-select {
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 20 20' fill='none'%3E%3Cpath opacity='0.375' fill-rule='evenodd' clip-rule='evenodd' d='M10 18a8 8 0 100-16 8 8 0 000 16zm0 2C4.477 20 0 15.523 0 10S4.477 0 10 0s10 4.477 10 10-4.477 10-10 10z' fill='%236b7280'/%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M10 3.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V4a.75.75 0 01.75-.75zM9.25 17.75a.75.75 0 001.5 0V15a.75.75 0 00-1.5 0v2.75zM13.75 10a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5h2.25a.75.75 0 01.75.75zM3.25 10a.75.75 0 01.75-.75H6a.75.75 0 010 1.5H4a.75.75 0 01-.75-.75z' fill='%236b7280'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 12px center;
                background-size: 18px 18px;
                padding-right: 45px !important;
            }
        </style>
        `);
        }

        return $target; // Return select itself for duration tracking
    }

    function showLoaderDuration($target, startTime) {
        const duration = Date.now() - startTime;
        console.log(`AJAX completed in ${duration}ms`);
        $target.removeClass("loading-select");
    }

    function populateDropdown($select, response, options = {}) {
        $select.empty();
        $select.append(
            '<option value="" disabled selected>' +
                (options.placeholder || "Select option") +
                "</option>"
        );

        if (Array.isArray(response) && response.length > 0) {
            $.each(response, function (index, item) {
                $select.append(
                    `<option value="${item.id}">${
                        item.name || item.text
                    }</option>`
                );
            });
        } else {
            $select.append('<option value="">No options available</option>');
        }

        $select.prop("disabled", false);
        $select.trigger("change"); // Trigger any dependent logic
    }

    function handleAjaxError($select, xhr, status, error, $trigger) {
        console.error("AJAX Error:", xhr.responseText || error);

        $select
            .empty()
            .append('<option value="">Error loading options</option>');
        $select.prop("disabled", false);

        // Show alert
        alert(
            `Failed to load options: ${
                status === "timeout" ? "Request timed out" : "Server error"
            }. Please try again.`
        );

        // Reset trigger and re-enable
        $trigger.val("").trigger("change");
    }
});
