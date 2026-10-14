<?php

declare(strict_types=1);

$harmone = '/assets/harmone/images';

$authorAvatar = "{$harmone}/rBzCXq2OPRoBvPkyXAb1Btonbg20cf.png";
$authorBio = [
    'name' => 'Lawn Care and Snow Removal Experts',
    'role' => 'Property Care Team',
    'image' => "{$harmone}/2dMqJdnNLwNlNap3cLOh0tpaSxo20cf.png",
    'text' => 'Our team provides year-round lawn care, seasonal cleanup, junk removal, and snow removal across Spruce Grove, Edmonton, and surrounding Alberta communities.',
];

function blogEntry(string $readingTime, array $quote, array $sections, array $authorBio, string $authorAvatar): array
{
    return [
        'reading_time' => $readingTime,
        'author_avatar' => $authorAvatar,
        'quote' => $quote,
        'sections' => $sections,
        'author_bio' => $authorBio,
    ];
}

$posts = [
    'spring-lawn-cleanup-guide' => blogEntry('7 min read', [
        'text' => 'With only about five months of active growth in Edmonton, a rushed or mistimed spring clean-up does not leave much runway to catch up before fall dormancy sets in again.',
        'author' => 'Lawn Care and Snow Removal Experts',
        'role' => 'Property Care Team',
    ], [
        ['type' => 'paragraph', 'text' => 'Edmonton\'s growing season only runs about five months — roughly Victoria Day to Thanksgiving — which means there is no room to waste the first few weeks after snowmelt. What you do in spring sets the tone for how your lawn handles the rest of the year. Here is what to prioritize, in the order our local climate calls for.'],
        ['type' => 'heading', 'text' => '1. Mid-April: Assess Winter Damage'],
        ['type' => 'paragraph', 'text' => 'As soon as the snow is mostly gone, walk the whole property. Look for matted or discoloured patches, bare spots, and any areas that took visible damage over winter. Flagging problems now means you can plan the right fix instead of reacting later.'],
        ['type' => 'heading', 'text' => '2. Early May: Rake Out Snow Mould'],
        ['type' => 'paragraph', 'text' => 'Grey or pink matted patches revealed at snowmelt are snow mould — one of the most common spring issues in this climate, especially where snow sat deepest against fences or on the north side of the house. Rake firmly to break up the matting and let air circulate; most cases recover on their own once the grass can breathe again. This is also the point to clear away any leaves, twigs, and other debris left over winter.'],
        ['type' => 'heading', 'text' => '3. Wait for the Soil to Firm Up'],
        ['type' => 'paragraph', 'text' => 'It is tempting to get out there the moment the snow disappears, but working on soggy spring soil compacts it and can tear up soft grass. Give the ground a chance to firm up before you start raking hard, aerating, or walking equipment across it.'],
        ['type' => 'heading', 'text' => '4. Dethatch Before You Aerate'],
        ['type' => 'paragraph', 'text' => 'If thatch has built up past about half an inch, it will block water and nutrients from reaching the soil — clear it out before aerating so the two jobs work together instead of against each other.'],
        ['type' => 'heading', 'text' => '5. Mid-May: First Fertilizer of the Season'],
        ['type' => 'paragraph', 'text' => 'Hold off on fertilizing until soil temperature reaches around 10°C, which typically lands in mid-May here — applying too early wastes product on soil that is not active yet. A slow-release, balanced fertilizer at this point gives roots what they need coming out of winter dormancy.'],
        ['type' => 'heading', 'text' => '6. Late May: Do Not Miss the Crabgrass Window'],
        ['type' => 'paragraph', 'text' => 'If crabgrass or other weeds have been a problem on your property, a pre-emergent needs to go down before late May to actually work. Miss this window and you are stuck spot-treating all summer instead.'],
        ['type' => 'heading', 'text' => '7. Overseed Bare Patches — But Know the Trade-Off'],
        ['type' => 'paragraph', 'text' => 'Spring overseeding (May–June) is possible, but it is less reliable here than a proper fall overseed, since new seedlings often run straight into summer heat stress before they are established. If a bare patch is not urgent, plan to overseed properly in September instead.'],
        ['type' => 'heading', 'text' => '8. Tidy Beds, Edges, and Hard Surfaces'],
        ['type' => 'paragraph', 'text' => 'Redefine lawn edges, clear out garden beds, and blow off walkways and driveways. Crisp edges are what make a property look genuinely cared for from the curb — and they are far easier to establish now than to hunt for later in the season.'],
        ['type' => 'image', 'src' => "{$harmone}/DaESr6wYDxsifUf6z721LznHQeEffb3.png", 'alt' => 'Spring lawn clean-up in Edmonton'],
        ['type' => 'heading', 'text' => 'Hand It Off to a Local Crew'],
        ['type' => 'paragraph', 'text' => 'If you would rather hand this off, our spring clean-up service is built around this exact local timeline — debris removal, dethatching, aeration, and bed edging in one visit. Get in touch and we will get your property on the schedule.'],
    ], $authorBio, $authorAvatar),

    'pro-tips-regular-lawn-maintenance' => blogEntry('7 min read', [
        'text' => 'A great lawn is not luck — it is a handful of habits done consistently, and timed to how grass actually behaves in Edmonton\'s short growing season and cold winters.',
        'author' => 'Lawn Care and Snow Removal Experts',
        'role' => 'Property Care Team',
    ], [
        ['type' => 'paragraph', 'text' => 'A great lawn is not luck — it is a handful of habits done consistently, and timed to how grass actually behaves in Edmonton\'s short growing season and cold winters. Here is what our crews rely on to keep local lawns thick, green, and resilient.'],
        ['type' => 'heading', 'text' => '1. Know What You Are Growing'],
        ['type' => 'paragraph', 'text' => 'Most lawns around Edmonton are built on Kentucky Bluegrass, prized for its cold hardiness and its ability to self-repair through underground rhizomes — a real advantage in a Zone 3b/4a climate. If you have shaded areas under trees or along a north-facing fence, Fine Fescue is the better performer there. Knowing which grass you are working with changes how you should water, fertilize, and even how worried to be when things go brown.'],
        ['type' => 'heading', 'text' => '2. Mow High, Mow Often, Mow Sharp'],
        ['type' => 'paragraph', 'text' => 'Never remove more than a third of the blade length in a single cut — if grass is getting away on you, mow more frequently rather than scalping it back. Kentucky Bluegrass kept at a proper height builds the deeper root system it needs to survive our hot, dry stretches in July and August. Always keep your mower blades sharp — a dull blade tears grass instead of cutting it cleanly.'],
        ['type' => 'heading', 'text' => '3. Water Deep, Not Often — and Expect Dormancy'],
        ['type' => 'paragraph', 'text' => 'Our growing season runs roughly Victoria Day to Thanksgiving, and annual precipitation in the 350–530mm range means supplemental watering matters through the summer. Aim for one to two deep waterings a week, around 25mm each, done before 9am. If your lawn turns tan and crispy in a July or August dry spell, that is usually normal drought dormancy for Kentucky Bluegrass — water about once every three weeks to keep the crowns alive, and resist pushing it back to green with nitrogen fertilizer during dormancy.'],
        ['type' => 'heading', 'text' => '4. Feed on Edmonton\'s Schedule'],
        ['type' => 'paragraph', 'text' => 'Timing your fertilizer to our soil and season makes a bigger difference than the product itself. Hold off on the first application until soil temperature reaches about 10°C, typically mid-May. The two applications that matter most are in fall: a September feed to support root development, followed by a high-potassium winterizer in early October that hardens the lawn off before the ground freezes.'],
        ['type' => 'heading', 'text' => '5. Aerate to Break Up Compaction'],
        ['type' => 'paragraph', 'text' => 'Core aeration relieves compacted soil so water, air, and nutrients can actually reach the root zone — and September is the ideal local window, since it pairs naturally with fall fertilizing and gives roots time to recover before freeze-up.'],
        ['type' => 'list', 'title' => '6. Watch for Local Problem Signs', 'items' => [
            ['title' => 'Snow mould', 'body' => 'Appears as matted grey or pink patches when snow melts in April, usually where snow sat deepest. Rake firmly to break it up and let air circulate — most cases recover on their own.'],
            ['title' => 'Chinch bugs', 'body' => 'Cause irregular yellow-brown patches expanding from lawn edges during hot, dry stretches in July. Check grass stems at soil level for small red-black insects to confirm before treating.'],
            ['title' => 'Drought dormancy', 'body' => 'Often mistaken for lawn death but is a normal survival response during summer dry spells.'],
        ]],
        ['type' => 'heading', 'text' => '7. Keep Debris Off the Grass Year-Round'],
        ['type' => 'paragraph', 'text' => 'Leaves, sticks, and equipment left sitting on the lawn trap moisture and block sunlight, which can smother grass or invite disease in days — and locally, leaf cover left over winter is one of the biggest contributors to spring snow mould. A regular debris check, especially heading into fall, prevents a lot of avoidable damage.'],
        ['type' => 'image', 'src' => "{$harmone}/eW46cLJR4pk9p8HZgiCoj2s2cd51e.png", 'alt' => 'Healthy Edmonton lawn maintenance'],
        ['type' => 'paragraph', 'text' => 'If you would rather leave the schedule to us, our regular maintenance visits are built around exactly these fundamentals for our climate — reach out and we will put together a plan for your property.'],
    ], $authorBio, $authorAvatar),

    'fall-lawn-cleanup-guide' => blogEntry('8 min read', [
        'text' => 'What you do in September and October has more impact on next spring\'s lawn than almost anything you will do once the snow melts.',
        'author' => 'Lawn Care and Snow Removal Experts',
        'role' => 'Property Care Team',
    ], [
        ['type' => 'paragraph', 'text' => 'Winter arrives fast here, and once the ground freezes, your options run out. What you do in September and October has more impact on next spring\'s lawn than almost anything you will do once the snow melts. Here is what actually matters before freeze-up, on Edmonton\'s timeline.'],
        ['type' => 'heading', 'text' => '1. Stay on Top of Leaves'],
        ['type' => 'paragraph', 'text' => 'A thick layer of leaves left on the lawn blocks sunlight and traps moisture — one of the biggest contributors to the snow mould you will otherwise be raking out in April. Clearing leaves as they fall, rather than letting them pile up for one big cleanup, keeps the grass underneath healthier and makes the job far more manageable.'],
        ['type' => 'heading', 'text' => '2. Clear Sticks and Branches Too'],
        ['type' => 'paragraph', 'text' => 'Sticks and branches that come down with the leaves can flatten and smother grass just as easily if left sitting under the snow all winter. A full debris pass — not just leaves — is what actually protects the lawn.'],
        ['type' => 'heading', 'text' => '3. September: Core Aerate and Feed'],
        ['type' => 'paragraph', 'text' => 'September is the prime local window for both core aeration and a fall fertilizer application. Aeration opens up soil compacted from a full season of use, and the fertilizer that follows can actually reach the roots. This is also the best window to overseed thin or bare patches: soil is still warm, air is cooling down, and new seedlings get a much better shot at establishing than they would in spring.'],
        ['type' => 'heading', 'text' => '4. Early October: Apply Your Winterizer'],
        ['type' => 'paragraph', 'text' => 'A high-potassium winterizer fertilizer, applied in early October, hardens the lawn off and strengthens roots heading into our winter lows, which can drop to -20°C to -40°C. This is the single application most likely to determine whether your lawn greens up quickly next spring or comes out of winter stressed.'],
        ['type' => 'heading', 'text' => '5. Late October: The Final Mow'],
        ['type' => 'paragraph', 'text' => 'Give the lawn its last cut of the season at around 60–65mm — noticeably lower than summer height, but not scalped. Grass left too long under snow is more prone to matting and snow mould; cut too short, it heads into winter with less energy reserve.'],
        ['type' => 'heading', 'text' => '6. Define Your Edges Before Winter Hides Them'],
        ['type' => 'paragraph', 'text' => 'Crisp lawn edges and clean lines along beds, walkways, and driveways make a property look finished — and it is much easier to establish those clean lines now than to find them again under spring mud and matted grass.'],
        ['type' => 'heading', 'text' => '7. Do a Full Property Blowout'],
        ['type' => 'paragraph', 'text' => 'Beyond the lawn itself, clearing hard surfaces and hidden corners of the property before the snow flies prevents debris from freezing in place and causing a bigger mess once things start melting again.'],
        ['type' => 'cards', 'items' => [
            ['title' => 'Basic Fall Clean-Up', 'text' => 'Covers the essentials — leaf and debris clean-up, a final mow and trim, and a full hard-surface blow-off.'],
            ['title' => 'Healthy Lawn Fall Package', 'text' => 'Builds on the Basic package with core aeration, a winterizer fertilizer application, and defined lawn edging.'],
            ['title' => 'Ultimate Fall Reset', 'text' => 'The complete package: everything above, plus perimeter edging, a full property blowout, and bagged debris removal with haul-away.'],
        ]],
        ['type' => 'image', 'src' => "{$harmone}/N3EH2aYxztDfWWLXB6YULO3bzpEd51e.png", 'alt' => 'Fall lawn clean-up in Edmonton'],
        ['type' => 'paragraph', 'text' => 'Given how quickly Edmonton moves from fall into hard freeze, our booking slots fill up fast once the leaves really start coming down. Reach out and we will help you pick the right package for your property.'],
    ], $authorBio, $authorAvatar),

    'junk-removal-guide' => blogEntry('6 min read', [
        'text' => 'Clearing out furniture, appliances, renovation debris, or years of accumulated clutter sounds simple until you actually start — and in Edmonton, what you can put at the curb is not always obvious.',
        'author' => 'Lawn Care and Snow Removal Experts',
        'role' => 'Property Care Team',
    ], [
        ['type' => 'paragraph', 'text' => 'Clearing out furniture, appliances, renovation debris, or years of accumulated clutter sounds simple until you actually start — and in Edmonton, what you can put at the curb, what you cannot, and where the rest needs to go is not always obvious. Here is what property owners should know.'],
        ['type' => 'heading', 'text' => 'Curbside Garbage Is Not Built for Bulky Items'],
        ['type' => 'paragraph', 'text' => 'Regular curbside collection is designed for bagged household waste, not furniture, mattresses, appliances, or renovation materials. Large items set out on their own — including anything placed beside a bin or dumpster — generally will not be picked up by waste services, and responsibility for disposing of them properly falls back on the property owner.'],
        ['type' => 'heading', 'text' => 'Different Items Need Different Disposal Routes'],
        ['type' => 'list', 'title' => 'Common disposal streams in Edmonton', 'items' => [
            ['title' => 'Bulky household items', 'body' => 'Furniture, mattresses, and large household goods need dedicated bulky-item disposal, not regular garbage.'],
            ['title' => 'Electronics (e-waste)', 'body' => 'TVs, computers, monitors, and similar equipment typically need a dedicated e-waste stream rather than general garbage.'],
            ['title' => 'Household hazardous waste', 'body' => 'Paints, chemicals, batteries, and similar items cannot go in regular trash at all.'],
            ['title' => 'Renovation debris', 'body' => 'Drywall, flooring, fixtures, and similar materials usually need to be taken to a dedicated waste facility rather than curbside.'],
        ]],
        ['type' => 'heading', 'text' => 'Weight and Volume Add Up Fast'],
        ['type' => 'paragraph', 'text' => 'A single mattress or a couple of old appliances is manageable in a weekend. A basement clean-out, a moving purge, a hoarding situation, or post-renovation debris is a different scale entirely — often more truck trips, more sorting, and more physical labour than people expect going in.'],
        ['type' => 'list', 'title' => 'When it makes sense to bring in help', 'items' => [
            ['title' => 'Time-sensitive clean-outs', 'body' => 'Move-outs, estate clean-ups, or a property that needs to be ready for sale or new tenants on a deadline.'],
            ['title' => 'Large volume', 'body' => 'Anything beyond a trunk-load or two, where multiple trips to a disposal facility are not practical.'],
            ['title' => 'Mixed material types', 'body' => 'Jobs that involve furniture, appliances, and general debris together, where sorting into the right disposal stream is time-consuming.'],
            ['title' => 'Heavy or awkward items', 'body' => 'Appliances, large furniture, or construction debris that is difficult or unsafe to move alone.'],
        ]],
        ['type' => 'image', 'src' => "{$harmone}/LRaag5i2gBTSGKrdYZ48WjZnwDY5b18.png", 'alt' => 'Property clean-up and junk removal'],
        ['type' => 'heading', 'text' => 'Pair It With Your Seasonal Clean-Up'],
        ['type' => 'paragraph', 'text' => 'Junk removal often makes the most sense alongside a broader property clean-up — a spring clean-up is a natural time to finally deal with what accumulated over winter, and a fall clean-up is a good checkpoint before things get buried under snow for months. If you would rather skip the sorting and the trips to the depot, reach out and we will take care of the pickup and proper disposal for you.'],
    ], $authorBio, $authorAvatar),

    'snow-removal-guide' => blogEntry('7 min read', [
        'text' => 'In a climate that delivers over a metre of snow a season and swings through repeated freeze-thaw cycles, reliable snow removal is really a risk-management decision, not just a curb-appeal one.',
        'author' => 'Lawn Care and Snow Removal Experts',
        'role' => 'Property Care Team',
    ], [
        ['type' => 'paragraph', 'text' => 'Edmonton sees roughly 100–130cm of snow in a typical season, and winter lows that regularly drop to -20°C or colder. That combination makes snow removal less of a convenience here than a genuine safety and liability issue. Here is what property owners should actually know.'],
        ['type' => 'heading', 'text' => 'You Are Legally Responsible for Your Sidewalks'],
        ['type' => 'paragraph', 'text' => 'Under the City of Edmonton\'s Community Standards Bylaw, property owners and occupants are required to keep the sidewalk adjacent to their land clear of snow and ice — cleared to the surface, across the full width and length. Insurance providers are consistent on this too: if someone is injured on an uncleared walkway in front of your property, you can be held liable.'],
        ['type' => 'heading', 'text' => 'Why Every Storm Matters More Than Once a Week'],
        ['type' => 'paragraph', 'text' => 'The properties that stay safest and most compliant are the ones on a trigger-based schedule — dispatched any time a set threshold of snowfall hits, rather than on a fixed weekly visit. A light 2cm overnight snowfall left to get walked on and refrozen becomes a much bigger hazard, and a much harder job, than if it had been cleared before anyone stepped on it.'],
        ['type' => 'cards', 'items' => [
            ['title' => 'Walkways only', 'text' => 'Front walks and high-traffic paths for properties that need targeted clearing.'],
            ['title' => 'Single driveway + walks', 'text' => 'A good fit for most residential properties with one driveway and front walkways.'],
            ['title' => 'Dual or corner lot', 'text' => 'Expanded coverage for larger driveways, corner lots, or triple-driveway layouts.'],
            ['title' => 'Extreme tier', 'text' => 'Dispatches for any accumulation with more frequent visits during multi-day snow events — suited to businesses and high-traffic properties.'],
        ]],
        ['type' => 'heading', 'text' => 'Watch for Refreeze, Not Just New Snow'],
        ['type' => 'paragraph', 'text' => 'Edmonton\'s winters are not just cold — they are variable. A mild afternoon followed by an overnight freeze can turn cleared, damp pavement into a sheet of ice by morning, even without a fresh snowfall. Snow clearing and ice management are two related but separate jobs — see our companion article on ice management for more detail.'],
        ['type' => 'image', 'src' => "{$harmone}/kah8B3dDQ5Vowbe1nFgXhVA5Pw5c3e.png", 'alt' => 'Residential snow removal in Edmonton'],
        ['type' => 'paragraph', 'text' => 'If you would like help figuring out the right coverage and response tier for your property, reach out — we will walk you through the options before the season gets busy.'],
    ], $authorBio, $authorAvatar),

    'ice-management-guide' => blogEntry('6 min read', [
        'text' => 'In a climate defined as much by freeze-thaw swings as by snowfall totals, ice is often the bigger day-to-day liability — and it is the one that is easiest to miss.',
        'author' => 'Lawn Care and Snow Removal Experts',
        'role' => 'Property Care Team',
    ], [
        ['type' => 'paragraph', 'text' => 'It is tempting to think of ice as just leftover snow, but in Edmonton\'s climate, ice management is really its own problem — driven less by how much snow falls and more by how often the temperature swings back and forth across freezing.'],
        ['type' => 'heading', 'text' => 'Why Edmonton Is Especially Prone to Ice'],
        ['type' => 'paragraph', 'text' => 'Chinook winds can push Alberta temperatures up sharply for a day or two in the middle of winter, melting surface snow — which then refreezes hard the moment temperatures drop back down. That freeze-thaw cycle, repeated multiple times through a single winter, is what turns driveways, walkways, and parking areas into sheets of ice, often with little or no fresh snowfall involved.'],
        ['type' => 'heading', 'text' => 'Black Ice Is the Real Danger'],
        ['type' => 'paragraph', 'text' => 'Black ice forms when surface temperatures sit between about +4°C and -4°C — exactly the range Edmonton spends a lot of time in during shoulder-season cold snaps and chinook swings. It is thin and transparent enough to let the pavement underneath show through, so it often just looks like a wet or slightly darker patch rather than obvious ice. On a driveway or front walkway, that makes it far more dangerous than a visible layer of packed snow.'],
        ['type' => 'heading', 'text' => 'Ice Melt Works — But Not at Any Temperature'],
        ['type' => 'paragraph', 'text' => 'Most standard de-icing products lose effectiveness as temperatures drop into the deep cold — the same application that clears a walkway on a -5°C day may barely touch the ice on a -25°C morning. Getting real value out of ice melt means applying it proactively before a refreeze sets in, and using product rates suited to the actual temperature.'],
        ['type' => 'heading', 'text' => 'You Are on the Hook for Your Sidewalks, Ice Included'],
        ['type' => 'paragraph', 'text' => 'Edmonton\'s Community Standards Bylaw does not just cover snow — it requires property owners and occupants to keep the sidewalk adjacent to their property clear of ice as well, cleared down to the surface across its full width. Ice is often the harder half of that requirement to stay ahead of, since it can form well after the last snowfall.'],
        ['type' => 'list', 'title' => 'A proactive approach beats a reactive one', 'items' => [
            ['title' => 'Watch for black ice conditions', 'body' => 'Temperatures hovering near freezing, especially after a chinook, are the highest-risk windows.'],
            ['title' => 'Apply ice melt ahead of refreeze', 'body' => 'Treat before a visible problem forms rather than waiting until walkways are already hazardous.'],
            ['title' => 'Prioritize high-traffic and shaded areas', 'body' => 'North-facing and shaded surfaces hold ice longer than sun-exposed pavement.'],
            ['title' => 'Pair with regular snow clearing', 'body' => 'Compacted, walked-on snow is one of the most common precursors to ice.'],
        ]],
        ['type' => 'image', 'src' => "{$harmone}/tfZ57gTKoyUYhYJGGuFrAnhOo83b2.png", 'alt' => 'Ice management on Edmonton walkways'],
        ['type' => 'paragraph', 'text' => 'If you would like ice melt application built into your winter service rather than handled as an afterthought, get in touch and we will set it up as part of your season plan.'],
    ], $authorBio, $authorAvatar),
];

$export = "<?php\n\n\$harmone = '/assets/harmone/images';\n\nreturn ".var_export($posts, true).";\n";

file_put_contents(__DIR__.'/config/blog_content.php', $export);

echo 'Wrote config/blog_content.php with '.count($posts)." posts.\n";
